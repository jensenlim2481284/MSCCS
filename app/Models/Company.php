<?php

namespace App\Models;

use App\Observers\CompanyObserver;
use Illuminate\Database\Eloquent\Model;

class Company extends Model 
{

    # Model Setting 
    use ModelHelper;
    protected $table = 'company';
    protected $guarded = ['id'];
    protected $hidden = ['id'];


    # Model Boot  
    public static function boot()
    {

        # Default data processing 
        parent::boot();
        Company::observe(CompanyObserver::class);

    }



    /*************************************************
     
                    MODEL RELATION 

    **************************************************/
         
    
    # Relation to access company keyword
    public function keyword()
    {
        return $this->hasMany('App\Models\Keyword','company_id','id');
    }



   
}
