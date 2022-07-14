<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PatientManagementController;
use App\Http\Controllers\CovidRecordsController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProvinceController;
use App\Http\Controllers\LocationsController;

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
    return redirect('/login');
});

Auth::routes();
Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');

Route::prefix('psAdmin')->group(function () {

    Route::group(['middleware' => ['auth']], function () {
        Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');

        Route::get('/totalcases',[CovidRecordsController::class,'getTotalCases'])->name('case.total.cases');

        Route::get('/covidrecords', 'App\Http\Controllers\PatientManagementController@index')->name('patients');
        Route::get('/covidrecords/patient/detail/{id}',[PatientManagementController::class,'patient_detail'])->name('patient.detail');
        Route::post('/covidrecords/patient/detail/{id}',[PatientManagementController::class,'patient_detail'])->name('patient.detail');
        Route::get('/covidrecords/searchPatientByName',[PatientManagementController::class,'searchPatientByName'])->name('search-patient');
        Route::match(['get', 'post'], '/covidrecords/addpatient', [PatientManagementController::class,'add_patient'])->name('patient.add');
        Route::post('/upload-patients',[PatientManagementController::class,'uploadPatients'])->name('upload');


        Route::match(['get', 'post'], '/changepassword', [UserController::class,'change_password'])->name('changepassword');
        
    });

    Route::get('provinces',[ProvinceController::class,'getProvinces'])->name('provinces');
    
    Route::get('locations/{province_id}',[LocationsController::class,'getLocations'])->name('locations');
});


