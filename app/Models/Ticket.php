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
        return $this->belongsTo('App\Models\Customer','customer_id','id');
    }

    
    # Function to access keyword
    public function keyword()
    {  
        return $this->belongsToMany(Keyword::class, 'ticket_keyword','ticket_id','keyword_id');      
    }
    
}
