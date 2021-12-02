<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostEmployeeRequest;
use App\Imports\EmployeeImport;
use App\Models\Company;
use App\Models\Employe;
use App\Repository\EmployeeRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use PDF;

class EmployeesController extends Controller
{
    
    private $employeeRepository;

    public function __construct(EmployeeRepository $employeeRepository)
    {
        $this->employeeRepository = $employeeRepository;

    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $employee = $this->employeeRepository->getAll();
        $rank = $this->employeeRepository->rank();
        return view('employee.index', compact('employee', 'rank'));
        
    }

    public function listEmployee($id) {
        $employee = $this->employeeRepository->listEmployee($id);
        $rank = $employee->firstItem();
        $company = $this->employeeRepository->companyId($id);

        return view('company.listemployee', compact('employee', 'company', 'rank'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('employee.create');
    }

    public function printPdf($id)
    { 
        $employee = Employe::where('id_company', $id)->orderBy('created_at', 'DESC')->get();
        // dd($em);
        $company = Company::find($id);
        $pdf = PDF::loadview('exportpdf',['employee'=>$employee]);
        return $pdf->download('List-company-'.$company->nama.'.pdf');
    }


    public function import(Request $request)
    {
        $this->validate($request, [
            'file' => 'required|mimes:csv,xls,xlsx'
        ]);

        $file = $request->file('file');

        // membuat nama file unik
        $nama_file = $file->hashName();

        //temporary file
        $path = $file->storeAs('public/excel/',$nama_file);
        
        $import = Excel::import(new EmployeeImport($request->id_company), storage_path('app/public/excel/'.$nama_file));

        //remove from server
        Storage::delete($path);

        if($import) {
            //redirect
            return redirect()->route('admin.company.listemployee', $request->id_company);
        } else {
            //redirect
            return redirect()->route('admin.company.listemployee', $request->id_company)->with(['error' => 'Data Gagal Diimport!']);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePostEmployeeRequest $request)
    {
        //
        // dd($request);
        $employe = new Employe();
        $employe->nama = $request->nama;
        $employe->email = $request->email;
        $employe->id_company = $request->select_company;
        
        $employe->save();
        session()->flash('success', 'Berhasil simpan data');
        return redirect()->route('admin.employee.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $getemployee = Employe::find($id);
        return view('employee.edit', compact('getemployee'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StorePostEmployeeRequest $request, $id)
    {
        //
        $employe = Employe::findOrFail($id);
        $employe->nama = $request->nama;
        $employe->email = $request->email;
        $employe->id_company = $request->select_company;
        
        $employe->update();
        return redirect()
            ->back()
            ->withSuccess("Berhasil Update data ");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $employe = Employe::find($id);

        $employe->delete();
        return redirect()
            ->back()
            ->withSuccess("Berhasil Hapus data ");
    }
}
