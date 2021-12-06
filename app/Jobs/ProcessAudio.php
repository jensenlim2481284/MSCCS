<?php

namespace App\Jobs;

use App\Models\User;
use App\Models\Keyword;
use App\Services\Modzy;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;


class ProcessAudio implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    # Create job instance
    protected $stage, $ticket;
    public function __construct($stage, $ticket)
    {
        $this->stage = $stage;
        $this->ticket = $ticket;
    }

     # Function to handle job processing
    public function handle()
    {

        # Variable initial
        $ticket = $this->ticket;
        $companyID = $ticket->company_id;
        $stageList = getConfig('ticket.stage');
        $audio = 'data:audio/wav;base64,' . base64_encode(file_get_contents($ticket->audio_path));
        
        # Process audio by stage 
        switch($this->stage){

            # Pre process audio - detect audio language
            case $stageList['audio_pre_process'] :
                
                # Check if processed pre audio
                if($ticket->getMeta('stage') == $stageList['audio_pre_processed'])
                {                    
                    # Get job result                 
                    $result = json_decode(Modzy::getResult($ticket->getMeta('jobID')));

                    # Check if completed 
                    if($result->finished){

                        # Retrieve language 
                        $result = (array)$result->results->{"my-input"}->{"results.json"};
                        arsort($result);
                        
                        $ticket->update(['language'=> array_key_first($result)]);

                         # Update ticket stage
                        $ticket->updateMeta('stage', $stageList['audio_peri_process']);

                        # Create new job to handle audio peri process
                        ProcessAudio::dispatch($stageList['audio_peri_process'], $ticket);
                    
                    }
                    else {

                        # Wait 3 second and check again 
                        sleep(3);
                        ProcessAudio::dispatch($stageList['audio_pre_process'], $ticket);
                    }

                    return true;
                }
                else 
                {
                    
                    # Detect audio language
                    $result = json_decode(Modzy::detectAudioLanguage($audio));
                    
                    # Check if success
                    if($result->status == "SUBMITTED"){
                        $ticket->updateMeta('stage', $stageList['audio_pre_processed']);
                        $ticket->updateMeta('jobID', $result->jobIdentifier);
                        sleep(3);
                        ProcessAudio::dispatch($stageList['audio_pre_process'], $ticket);
                    }   
                    else 
                        $ticket->update(['status', getConfig('ticket.status.error')]);

                    return true;

                }
                return true;




            # Audio Transacript - audio to text, Audio keyword spotting, translate to english 
            case $stageList['audio_peri_process'] :

                # Check if processed peri audio
                if($ticket->getMeta('stage') == $stageList['audio_peri_processed'])
                {  
                    
                    # Get Spotting job result 
                    $result = json_decode(Modzy::getResult($ticket->getMeta('spottingJobID')));

                    # Check if job completed 
                    if($result->finished){

                        # Retrieve keyword 
                        $results = (array)$result->results->{"my-input"}->{"results.json"};
                        $keywordEloquent = Keyword::where('company_id', $companyID);
                        $keywordList = (clone $keywordEloquent)->pluck('value')->toArray();
                        foreach($results as $result){

                            # Bind keyword if spotted
                            $result = (array)$result;
                            if(in_array($result['word'], $keywordList)){
                                $keyword = (clone $keywordEloquent)->where('value', $result['word'])->first();
                                \DB::table('ticket_keyword')::create([
                                    'ticket_id' => $ticket->id,
                                    'keyword_id' => $keyword->id,
                                ]);
                            }

                        }
                        
                        # Check if got translate job  
                        if($translateJobID = $ticket->getMeta('translateJobID')){

                            # Retrieve & update translated transcript 
                            $result = json_decode(Modzy::getResult($translateJobID));                          
                            $ticket->update(['transcript'=> $result->results->{"my-input"}->{"results.json"}->text]);

                        }

                        # Update ticket stage
                        $ticket->updateMeta('stage', $stageList['audio_post_process']);

                        # # Create new job to handle audio post process
                        ProcessAudio::dispatch($stageList['audio_post_process'],$ticket);
                    
                    }
                    else {

                        # Wait 3 second and check again 
                        sleep(3);
                        ProcessAudio::dispatch($stageList['audio_peri_process'], $ticket);
                    }

                    return true;

                }
                else 
                {
                    # Proceed audio to text 
                    $transcript = Modzy::audioTranscript(getConfig('ticket.language_code')[$ticket->language], $ticket->audio_path);

                    # Update transscript
                    $ticket->update(['transcript' => $transcript]);

                    # Process Audio keyword spotting
                    $checkProcess = true;
                    $spotting = json_decode(Modzy::audioKeywordSpotting($audio, $companyID));
                    $checkProcess = ($spotting->status  == "SUBMITTED");

                    # Translate to english 
                    if($ticket->language != 'en'){
                        $translate = json_decode(Modzy::translate($ticket->language, $ticket->transcript));     
                        $checkProcess = ($translate->status  == "SUBMITTED");        
                        $ticket->updateMeta('translateJobID', $translate->jobIdentifier);
                    }

                    # If Modzy Process is success
                    if($checkProcess){
                        $ticket->updateMeta('stage', $stageList['audio_peri_processed']);
                        $ticket->updateMeta('spottingJobID', $spotting->jobIdentifier);
                        sleep(3);
                        ProcessAudio::dispatch($stageList['audio_peri_process'], $ticket);
                    }   
                    else 
                        $ticket->update(['status', getConfig('ticket.status.error')]);

                    return true;

                }
         
                return true;


            # Audio Post Process - Sentiment Analysis,  named entity recognition , Text Topic Modeling , text summarization
            case $stageList['audio_post_process'] :
            
                # Check if processed post audio
                if($ticket->getMeta('stage') == $stageList['audio_post_processed'])
                {  

                    # Get sentiment job result & check if sentiment job finished ( longest job in the post audio process )
                    $sentimentResult = json_decode(Modzy::getResult($ticket->getMeta('sentimentJobID')));  
                    \Storage::put('sentimentResult.txt', $sentimentResult);                  
                    if($sentimentResult && isset($sentimentResult->finished) && $sentimentResult->finished){


                        # Update sentiment result to ticket 
                        $ticket->updateMeta('sentiment', (array)$sentimentResult->results->{"my-input"}->{"results.json"}->data->result->classPredictions);

                        # Get Entity job result 
                        $entityResult = json_decode(Modzy::getResult($ticket->getMeta('entityJobID')));                        

                        # Check entity and create customer record - if person name and location name found
                        $entityArr = (array)$entityResult->results->{"my-input"}->{"results.json"};
                        $name = null; $country = null;
                        foreach($entityArr as $arr){
                            switch($arr[1]){
                                case "B-PER" : $name = $arr[0]; break;
                                case "I-PER" : $name .= ' ' . $arr[0]; break;
                                case "B-LOC" : $country = $arr[0]; break;
                                case "I-LOC" : $country .= ' '. $arr[0]; break;
                            }
                        }      

                        # If name detected - create customer record
                        if($name)              
                        {
                            $customer = User::create([
                                'role_id' => getConfig('role.customer'),
                                'company_id' => $companyID,
                                'name' => $name,
                                'country' => $country,
                                'language' => getConfig('ticket.language_text')[$ticket->language]
                            ]);
                            $ticket->update(['customer_id' => $customer->id]);
                        }

                        # Get summarization job result 
                        $summarizationResult = json_decode(Modzy::getResult($ticket->getMeta('summarizationJobID')));

                        # Get summarization result and Update ticket description 
                        $ticket->update(['description' => $summarizationResult->results->{"my-input"}->{"results.json"}->summary]);
                        
                        # Get text modeling job result 
                        $modelResult = json_decode(Modzy::getResult($ticket->getMeta('modelingJobID')));
                        $modelArr = (array)$modelResult->results->{"my-input"}->{"results.json"};

                        # Get top 3 topic and update ticket title for document classification
                        $title = $modelArr[0] . ' | ' . $modelArr[1] . ' | ' . $modelArr[2];
                        $ticket->update(['title' => $title]);
                   
                        # Mark audio processing as completed 
                        $meta = $ticket->getMeta();
                        $meta->stage = $stageList['completed'];
                        $ticket->update(['status' => getConfig('ticket.status.completed'), 'meta'=> json_encode($meta)]);

                        return true;

                    }
                    else {

                        # Wait 5 second and check again 
                        sleep(5);
                        ProcessAudio::dispatch($stageList['audio_post_process'], $ticket);

                    }

                    return true;
                       
                }
                else 
                {
                
                    # Process Name entity recognition                    
                    $entity = json_decode(Modzy::nameEntityRecognition($ticket->transcript));
                    $checkProcess = ($entity->status  == "SUBMITTED");
                
                    # Process text topic modeling                   
                    $modeling = json_decode(Modzy::textTopicModeling($ticket->transcript));
                    $checkProcess = ($modeling->status  == "SUBMITTED");
                
                    # Process text summarization                 
                    $summarization = json_decode(Modzy::textSummarization($ticket->transcript));
                    $checkProcess = ($summarization->status  == "SUBMITTED");

                    # Process Sentiment Analysis
                    $checkProcess = true;
                    $sentiment = json_decode(Modzy::sentimentAnalysis($ticket->transcript));
                    $checkProcess = ($sentiment->status  == "SUBMITTED");
                    
                    # If Modzy Process is success
                    if($checkProcess){
                        $meta = [
                            'sentimentJobID' =>  $sentiment->jobIdentifier,
                            'entityJobID' =>  $entity->jobIdentifier,
                            'modelingJobID' =>  $modeling->jobIdentifier,
                            'summarizationJobID' =>  $summarization->jobIdentifier,
                            'stage' => $stageList['audio_post_processed']                       
                        ];
                        $ticket->update(['meta'=>json_encode($meta)]);
                        ProcessAudio::dispatch($stageList['audio_post_process'], $ticket);
                    }   
                    else 
                        $ticket->update(['status', getConfig('ticket.status.error')]);

                    return true;

                }
                return true;

        }

    }

}
