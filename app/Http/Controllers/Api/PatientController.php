<?php

namespace App\Http\Controllers\Api;

use App\Models\Patient;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PatientController extends Controller
{
    public function index()
    {
        $patients = Patient::all();
        return response()->json($patients);
    }

    public function store(Request $request)
    {
        $request->validate([
            'file_number' => 'required|unique:patients',
            'first_name' => 'required',
            'last_name' => 'required',
            'gender' => 'required',
            'date_of_birth' => 'required|date',
            'phone_number' => 'required',
            'next_of_kin_name' => 'required',
            'next_of_kin_relationship' => 'required',
            'next_of_kin_phone_number' => 'required',
        ]);

        $patient = Patient::create($request->all());

        return response()->json($patient, 201);
    }

    public function show(Patient $patient)
    {
        return response()->json($patient);
    }

    public function update(Request $request, Patient $patient)
    {
        $request->validate([
            'file_number' => 'required|unique:patients,file_number,' . $patient->id,
            'first_name' => 'required',
            'last_name' => 'required',
            'gender' => 'required',
            'date_of_birth' => 'required|date',
            'phone_number' => 'required',
            'next_of_kin_name' => 'required',
            'next_of_kin_relationship' => 'required',
            'next_of_kin_phone_number' => 'required',
        ]);

        $patient->update($request->all());

        return response()->json($patient);
    }

    public function destroy(Patient $patient)
    {
        $patient->delete();

        return response()->json(['message' => 'Patient deleted successfully']);
    }

    public function reactivate($id)
    {
        $patient = Patient::withTrashed()->findOrFail($id);
        $patient->restore();

        return response()->json(['message' => 'Patient reactivated successfully']);
    }
}
