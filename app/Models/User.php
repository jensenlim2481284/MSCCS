<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable 
{

    # Model Setting 
    use ModelHelper;
    protected $guarded = ['id'];
    protected $hidden = ['password', 'id'];
    

    # Model Boot
    public static function boot()
    {
        parent::boot();
        self::creating(function ($user) {
            $user->uid = generateReferenceKey('user_');
        });
    }




    /*************************************************
     
                    MODEL RELATIONSHIP 

    **************************************************/
     
    # Function to access company 
    public function company()
    {
        return $this->hasOne('App\Models\Company','id','company_id');
    }

     
    # Function to access call audio
    public function call()
    {
        return $this->hasMany('App\Models\Ticket','id','customer_id');
    }


}
