<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model 
{

    # Model Setting 
    use ModelHelper;
    protected $table = 'ticket';
    protected $guarded = ['id'];
    protected $hidden = ['id'];


    # Model Boot  
    public static function boot()
    {
        parent::boot();
        self::creating(function ($ticket) {
            $ticket->uid = generateReferenceKey('ticket_');                        
        });

    }


    # Function to get ticket stage percent
    public function getStagePercent(){
        return filterNumber($this->getMeta('stage')/7 *100);
    }


    # Function to get ticket stage name
    public function getStage(){
        return getConfig('ticket.stage_text')[$this->getMeta('stage')??1];
    }


    # Function to get ticket status 
    public function getStatus(){
        return getConfig('ticket.status_text')[$this->status];
    }


    # Function to get audio path
    public function getAudioPath(){
        $path =explode('/',  $this->audio_path);
        return '/storage/'. end($path);
    }


    # Function to check if audio is completed
    public function isCompleted(){
        return $this->status == getConfig('ticket.status.completed');
    }


    
    /*************************************************
     
                    MODEL RELATION 

    **************************************************/
         


    
    # Relation to access company
    public function company()
    {
        return $this->belongsTo('App\Models\Company','company_id','id');
    }

    
    # Relation to access customer
    public function customer()
    {
        return $this->belongsTo('App\Models\User','customer_id','id');
    }

    
    # Function to access keyword
    public function keyword()
    {  
        return $this->belongsToMany(Keyword::class, 'ticket_keyword','ticket_id','keyword_id');      
    }
    
}
