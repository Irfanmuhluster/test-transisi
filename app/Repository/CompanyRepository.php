<?php


namespace App\Repository;

use App\Models\Company;

class CompanyRepository 
{
    public function getAll() 
    {
        $company = Company::orderBy('created_at', 'DESC')->paginate('5');
        
        // $rank = $company->firstItem();

        return $company;
    }

    public function rank() {
        $rank = $this->getAll();

        return $rank;
    }
}