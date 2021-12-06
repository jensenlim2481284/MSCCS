<?php

namespace App\Observers;

use App\Models\Company;
use App\Models\Keyword;

class CompanyObserver
{


    # Use to process company data while creating 
    public function creating(Company $company){
        $company->uid = generateReferenceKey('company_');            
    }


    # Use to process company data after created
    public function created(Company $company)
    {

        # Update company default keyword setting 
        foreach(['Good'] as $key){
            Keyword::create([
                'company_id' => $company->id,
                'value' =>$key
            ]);
        }

    }

}
