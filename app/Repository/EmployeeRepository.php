<?php
namespace App\Repository;

use App\Models\Company;
use App\Models\Employe;

class EmployeeRepository
{
    public function getAll() 
    {
        $employee = Employe::orderBy('created_at', 'DESC')->paginate('5');;

        return $employee;
    }

    public function rank() {
        $rank = $this->getAll();

        return $rank;
    }

    public function listEmployee($id)
    {
        # code...
        $employee = Employe::where('id_company', $id)->orderBy('created_at', 'DESC')->paginate('5');
        return $employee;
    }

    public function companyId($id)
    {
        # code...
        $company = Company::find($id);

        return $company;
    }

}