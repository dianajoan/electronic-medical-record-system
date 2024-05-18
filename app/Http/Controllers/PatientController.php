<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    public function index()
    {
        $patients = Patient::all();
        return view('backend.patients.index', compact('patients'));
    }

    public function create()
    {
        return view('backend.patients.create');
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

        Patient::create($request->all());

        return redirect()->route('patients.index')
            ->with('success', 'Patient created successfully.');
    }

    public function show(Patient $patient)
    {
        return view('backend.patients.show', compact('patient'));
    }

    public function edit(Patient $patient)
    {
        return view('backend.patients.edit', compact('patient'));
    }

    public function update(Request $request, Patient $patient)
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

        $patient->update($request->all());

        return redirect()->route('patients.index')
            ->with('success', 'Patient updated successfully');
    }

    public function destroy(Patient $patient)
    {
        $patient->delete();

        return redirect()->route('backend.patients.index')
            ->with('success', 'Patient deleted successfully');
    }
}
