<?php

namespace App\Services;

use App\Models\Keyword;

use Google\Cloud\Speech\V1\SpeechClient;
use Google\Cloud\Speech\V1\RecognitionAudio;
use Google\Cloud\Speech\V1\RecognitionConfig;
use Google\Cloud\Speech\V1\RecognitionConfig\AudioEncoding;


class Modzy
{

    # Function to initial CURL
	protected static function curlInit()
	{

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_HEADER, false);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
        curl_setopt( $ch,  CURLOPT_HTTPHEADER, [
                'Content-Type: application/json',
                'Authorization: ApiKey '. env('API_TOKEN'), 
        ]);
		return $ch;
	}


    # Function to process CURL POST
	protected static function curlPostRequest($action, $data)
	{
        

        # Process CURL based on action 
		$ch = self::curlInit();
		curl_setopt($ch, CURLOPT_URL,  env('API_URL') . $action);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch,CURLOPT_RETURNTRANSFER, true); 
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		$result = curl_exec($ch);
		curl_close($ch);
		return $result;

	}

    
    # Function to process CURL GET
	protected static function curlGetRequest($action)
	{
        
        # Process CURL based on action 
		$ch = self::curlInit();
		curl_setopt($ch, CURLOPT_URL,  env('API_URL') . $action);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER, true); 
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		$result = curl_exec($ch);
		curl_close($ch);
		return $result;

	}


    # API to Detect Audio Language 
	public static function detectAudioLanguage($data) 
	{		
		return self::curlPostRequest('jobs', [
            "model" => [
                "identifier"=>"2c368011ef",
                "version"=>"0.0.1"
            ],
            "input" => [
                "type"=>"embedded",
                "sources"=>[
                    "my-input"=>[
                        "input.wav" => $data
                    ]
                ]
            ]
        ]);
	}


    # API to proceed  Audio keyword spotting
	public static function audioKeywordSpotting($audio, $companyID) 
	{		

        # Get keyword list 
        $keywordList = Keyword::where('company_id', $companyID)->pluck('value')->toArray();
        $keyword = 'data:text/plain;base64,' . base64_encode(implode('\n',$keywordList));

        return self::curlPostRequest('jobs', [
            "model" => [
                "identifier"=>"s25ge4ufw4",
                "version"=>"0.0.1"
            ],
            "input" => [
                "type"=>"embedded",
                "sources"=>[
                    "my-input"=>[
                        "word.txt" => $keyword,
                        "input.wav" => $audio
                    ]
                ]
            ]
        ]);
	}

    # API to translate text to english
	public static function translate($language, $transcript) 
	{		
        $model = ($language == 'chi')?[ "identifier"=>"24ntd2cn93","version"=>"0.0.2"]:["identifier"=>"5b98cvxsd2","version"=>"0.0.1"];
		return self::curlPostRequest('jobs', [
            "model" => $model,
            "input" => [
                "type"=>"text",
                "sources"=>[
                    "my-input"=>[
                        "input.txt" => $transcript
                    ]
                ]
            ]
        ]);
	}

    
    # API to process Sentiment Analysis
	public static function sentimentAnalysis($data) 
	{		
		return self::curlPostRequest('jobs', [
            "model" => [
                "identifier"=>"ed542963de",
                "version"=>"1.0.1"
            ],
            "input" => [
                "type"=>"text",
                "sources"=>[
                    "my-input"=>[
                        "input.txt" => $data
                    ]
                ]
            ]
        ]);
	}

    
    
    # API to process Name Entity Recognition
	public static function nameEntityRecognition($data) 
	{		
		return self::curlPostRequest('jobs', [
            "model" => [
                "identifier"=>"a92fc413b5",
                "version"=>"0.0.12"
            ],
            "input" => [
                "type"=>"text",
                "sources"=>[
                    "my-input"=>[
                        "input.txt" => $data
                    ]
                ]
            ]
        ]);
	}

    
    # API to process text topic modeling 
	public static function textTopicModeling($data) 
	{		
		return self::curlPostRequest('jobs', [
            "model" => [
                "identifier"=>"m8z2mwe3pt",
                "version"=>"0.0.1"
            ],
            "input" => [
                "type"=>"text",
                "sources"=>[
                    "my-input"=>[
                        "input.txt" => $data
                    ]
                ]
            ]
        ]);
	}
    

    # API to process text summarization  
	public static function textSummarization($data) 
	{		
		return self::curlPostRequest('jobs', [
            "model" => [
                "identifier"=>"rs2qqwbjwb",
                "version"=>"0.0.2"
            ],
            "input" => [
                "type"=>"text",
                "sources"=>[
                    "my-input"=>[
                        "input.txt" => $data
                    ]
                ]
            ]
        ]);
	}


    # API to get Job result
	public static function getResult($jobID) 
	{		
		return self::curlGetRequest('results/' . $jobID );
	}


    # Function to process audio transcript
	public static function audioTranscript($languageCode, $audioPath) 
	{		

        # Setup audio configuration
        $audio = (new RecognitionAudio())->setContent(file_get_contents($audioPath));
        $config = (new RecognitionConfig())
            ->setEncoding(AudioEncoding::LINEAR16)
            ->setAudioChannelCount(2)
            ->setLanguageCode($languageCode);

        # Initial Client
        $client = new SpeechClient(['credentials' => json_decode(file_get_contents('C:\laragon\www\MSCCS\storage\googleCloudKey.json'), true)]);

        # Proceed Transcript
        $operation = $client->longRunningRecognize($config, $audio);
        $operation->pollUntilComplete();

        # Retrieve result
        $responseText = '';
        if ($operation->operationSucceeded()) {
            $response = $operation->getResult();
            foreach ($response->getResults() as $result) 
                $responseText .= $result->getAlternatives()[0]->getTranscript();
        }
        
        # Close Client and return result
        $client->close();
        return $responseText;

	}



}
