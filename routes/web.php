<?php

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

use App\Http\Controllers\PatientController;
use App\Http\Controllers\MedicalRecordController;
use App\Http\Controllers\LabResultController;
use App\Http\Controllers\DrugPrescriptionController;


Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['register'=>false]);

Route::get('user/login','FrontendController@login')->name('login.form');
Route::post('user/login','FrontendController@loginSubmit')->name('login.submit');
Route::get('user/logout','FrontendController@logout')->name('user.logout');

Route::get('user/register','FrontendController@register')->name('register.form');
Route::post('user/register','FrontendController@registerSubmit')->name('register.submit');
// Reset password
Route::post('password-reset', 'FrontendController@showResetForm')->name('password.reset'); 

// Backend section start

Route::group(['prefix'=>'/admin','middleware'=>['auth','admin']],function(){
    Route::get('/','AdminController@index')->name('admin');

    //Routes for Users
    Route::resource('/users','UsersController');

    // Routes for PatientController
    Route::resource('/patients','PatientController');

    // Routes for MedicalRecordController
    Route::resource('/medical_records','MedicalRecordController');

    // Routes for LabTestController
    Route::resource('/lab_tests','LabTestController');

    // Routes for LabResultController
    Route::resource('/lab_results','LabResultController');

    // Routes for LabTestOrderController
    Route::resource('/lab_test_orders','LabTestOrderController');

    // Routes for LabResultOrderController
    Route::resource('/lab_result_orders','LabResultOrderController');

    // Routes for DiagnosisController
    Route::resource('/diagnosis','DiagnosisController');

    // Routes for ClinicController
    Route::resource('/clinics','ClinicController');

    // Routes for DrugPrescriptionController
    Route::resource('/drug_prescriptions','DrugPrescriptionController');
    
});
