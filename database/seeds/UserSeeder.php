<?php

use App\Models\User;
use App\Models\Company;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{

    # Create demo user account
    public function run()
    {

        User::create([
            'name' => 'Demo Admin',       
            'email' => 'demo@gmail.com',
            'password' => Hash::make('demo'),            
            'company_id' => Company::first()->id,            
            'role_id'=> getConfig('role.admin'),
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);

    }
    
}
