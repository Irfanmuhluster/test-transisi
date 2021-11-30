<?php

use App\Http\Controllers\Admin\CompanyController;
use App\Http\Controllers\Admin\EmployeesController;
use App\Models\Company;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::middleware('auth')->group(function () {
    Route::prefix('admin')->group(function () {
        Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

        // route company
        Route::resource('company', CompanyController::class)->except([
            'show',
        ])->names([
            'index' => 'admin.company.index',
            'create' => 'admin.company.create',
            'store' => 'admin.company.store',
            'update' => 'admin.company.update',
            'destroy' => 'admin.company.destroy',
            'edit'  => 'admin.company.edit'
        ]);

        Route::get('/company/listemployee/{id}', [EmployeesController::class, 'listEmployee'])->name('admin.company.listemployee');


        Route::get('/company/listemployee/{id}/print_pdf', [EmployeesController::class, 'printPdf'])->name('admin.company.printpdf');

        Route::post('/company/listemployee/import_pdf', [EmployeesController::class, 'import'])->name('admin.company.importpdf');

        // route employees
        Route::resource('employee', EmployeesController::class)->except([
            'show',
        ])->names([
            'index' => 'admin.employee.index',
            'create' => 'admin.employee.create',
            'store' => 'admin.employee.store',
            'update' => 'admin.employee.update',
            'destroy' => 'admin.employee.destroy',
            'edit'  => 'admin.employee.edit'
        ]);

        
        Route::get('/company/get/{param}', [CompanyController::class, 'searchByParam'])->name('get');

        
    });
});
