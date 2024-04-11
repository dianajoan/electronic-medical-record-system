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

use App\Http\Controllers\PatientController;
use App\Http\Controllers\MedicalRecordController;
use App\Http\Controllers\LabResultController;
use App\Http\Controllers\DrugPrescriptionController;

Route::prefix('v1')->group(function () {
    // Routes for patients
    Route::apiResource('patients', PatientController::class);

    // Routes for medical records
    Route::apiResource('medical-records', MedicalRecordController::class);

    // Routes for lab results
    Route::apiResource('lab-results', LabResultController::class);

    // Routes for drug prescriptions
    Route::apiResource('drug-prescriptions', DrugPrescriptionController::class);
});
