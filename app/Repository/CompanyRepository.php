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

    public function searchByParam($param = 'company') {
        $query = request()->query();
        if ($param == 'company') {
            //search
            
            $result = Company::select('id', 'nama')->search()->orderBy('nama', 'ASC')->get();
            // dd($result);
            $result->map(function($item) {
                $item['text'] = ucfirst($item['nama']);
                return $item;
            });

            
            return response([
                'status' => 200,
                'search' => $param,
                'query' => $query['q'],
                'result' => $result
            ]);

        }
    }

}