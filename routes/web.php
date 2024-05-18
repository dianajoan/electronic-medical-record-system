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

// use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['register' => false]);

// Backend section start
Route::group(['prefix' => '/admin', 'middleware' => ['auth', 'admin']], function() {
    Route::get('/','AdminController@index')->name('admin');

    // Routes for Users
    Route::resource('/users', 'UsersController');

    // Routes for Roles
    Route::resource('/roles', 'UserRoleController');

    // Routes for Diagnoses
    Route::resource('/diagnosis', 'DiagnosisController');

    // Routes for General Test
    Route::resource('/general_tests', 'GeneralTestController');

    // Routes for Patients
    Route::resource('/patients', 'PatientController');

    // Routes for Clinics
    Route::resource('/clinics', 'ClinicController');

    // Routes for Medical Records
    Route::resource('/medical_records', 'MedicalRecordController');

    // Routes for Lab Tests
    Route::resource('/lab_tests', 'LabTestController');

    // Routes for Lab Results
    Route::resource('/lab_results', 'LabResultController');

    // Routes for Lab Test Orders
    Route::resource('/lab_test_orders', 'LabTestOrderController');

    // Routes for Drugs
    Route::resource('/drugs', 'DrugController');

    // Routes for Drug Prescriptions
    Route::resource('/drug_prescriptions', 'DrugPrescriptionController');

    // Routes for Appointments
    Route::resource('/appointments', 'AppointmentController');

    
});