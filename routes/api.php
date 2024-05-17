<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//Routes for Users
Route::resource('/users','UsersController');

//Routes for Users
Route::resource('/roles','UserRoleController');

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

// Routes for DrugController
Route::resource('/drugs','DrugController');

// Routes for DrugPrescriptionController
Route::resource('/drug_prescriptions','DrugPrescriptionController');

// Routes for AppointmentController
Route::resource('/appointments','AppointmentController');

// Routes for ClinicController
Route::resource('/clinics','ClinicController');