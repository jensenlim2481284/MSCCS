<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Keyword extends Model 
{

    # Model Setting 
    use ModelHelper;
    protected $table = 'keyword';
    protected $guarded = ['id'];
    protected $hidden = ['id'];



    
    /*************************************************
     
                    MODEL RELATION 

    **************************************************/
         


    # Function to access company  
    public function company()
    {  
        return $this->belongsTo('App\Models\Company','company_id','id');
    }

        
    # Function to access ticket
    public function ticket()
    {  
        return $this->belongsToMany(Ticket::class, 'ticket_keyword','keyword_id','ticket_id');      
    }
    
}
