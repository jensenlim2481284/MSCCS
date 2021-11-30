<?php

use App\Models\Company;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    
    # Create demo company record
    public function run()
    {        
        Company::create([
            'name' => 'Demo Company',       
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);    
    }
    
}
