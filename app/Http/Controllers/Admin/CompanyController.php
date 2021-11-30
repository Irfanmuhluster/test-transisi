<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostCompanyRequest;
use App\Http\Requests\StoreUpdateCompanyRequest;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;


class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $company = Company::orderBy('created_at', 'DESC')->paginate('5');
        
        $rank = $company->firstItem();
        return view('company.index', compact('company', 'rank'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('company.create');
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePostCompanyRequest $request)
    {
        //

        if ($request->hasFile('logo')) {
            // create unique name
            $image_original_name = Str::uuid() . '.' . $request->logo->extension();
            $image_name =  Str::replace(' ', '-', $request->nama)."-{$image_original_name}";
            Storage::putFileAs(
                'company', $request->file('logo'), $image_name
            );
        }

        $company = new Company();
        $company->nama = $request->nama;
        $company->email = $request->email;
        $company->logo = $image_name;
        $company->website = $request->website;
        
        $company->save();
        session()->flash('success', 'Berhasil simpan data');
        return redirect()->route('admin.company.index');
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
        $getcompany = Company::find($id);
        return view('company.edit', compact('getcompany'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdateCompanyRequest $request, $id)
    {
        //
        $company = Company::find($id);
        if ($request->hasFile('logo')) {
            // create unique name
            $image_original_name = Str::uuid() . '.' . $request->logo->extension();
            $image_name =  Str::replace(' ', '-', $request->nama)."-{$image_original_name}";
            Storage::putFileAs(
                'company', $request->file('logo'), $image_name
            );

            $image_old_exists = Storage::exists("company/{$company->logo}");
            if ($image_old_exists) {
                Storage::delete("company/{$company->logo}");
            }        
            $company->logo = $image_name;
        }

        $company->nama = $request->nama;
        $company->email = $request->email;
        $company->website = $request->website;
        
        $company->update();
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
        $company = Company::find($id);
        
        $image_old_exists =  Storage::exists("company/{$company->logo}");
        if ($image_old_exists) {
            Storage::delete("company/{$company->logo}");
        }   

        $company->delete();
        return redirect()
            ->back()
            ->withSuccess("Berhasil Hapus data ");
    }
}
