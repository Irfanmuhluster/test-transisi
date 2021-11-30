<?php

namespace App\Imports;

use App\Models\Employe;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class EmployeeImport implements ToCollection
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function  __construct($id_company)
    {
        $this->id_company= $id_company;
    }

    public function collection(Collection $rows)
    {   
        // if(count($rows) < 101) {
        //     //redirect
        //     return redirect()->route('admin.company.listemployee', $this->id_company)->with(['error' => 'Data Gagal Diimport! , Record Data minimal 100']);
        // } else {
        foreach ($rows as $row) {
                Employe::create([
                'nama'     => $row[0],
                'email'    => $row[1],
                'id_company' => $this->id_company,
            ]);
        }
        //     return redirect()->route('admin.company.listemployee', $this->id_company)->with(['success' => 'Data Berhasil Diimport!']);
       
        // }   
    }
}
