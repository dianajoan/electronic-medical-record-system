<?php

namespace App\Http\Controllers;

use App\Models\MedicalRecord;
use Illuminate\Http\Request;

class MedicalRecordController extends Controller
{
    public function index()
    {
        $medicalRecords = MedicalRecord::all();
        return view('medical_records.index', compact('medicalRecords'));
    }

    public function create()
    {
        return view('medical_records.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'visit_date' => 'required|date',
            'chief_complaint' => 'required',
            // Add validation for other fields if necessary
        ]);

        MedicalRecord::create($request->all());

        return redirect()->route('medical_records.index')
            ->with('success', 'Medical record created successfully.');
    }

    public function show(MedicalRecord $medicalRecord)
    {
        return view('medical_records.show', compact('medicalRecord'));
    }

    public function edit(MedicalRecord $medicalRecord)
    {
        return view('medical_records.edit', compact('medicalRecord'));
    }

    public function update(Request $request, MedicalRecord $medicalRecord)
    {
        $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'visit_date' => 'required|date',
            'chief_complaint' => 'required',
            // Add validation for other fields if necessary
        ]);

        $medicalRecord->update($request->all());

        return redirect()->route('medical_records.index')
            ->with('success', 'Medical record updated successfully');
    }

    public function destroy(MedicalRecord $medicalRecord)
    {
        $medicalRecord->delete();

        return redirect()->route('medical_records.index')
            ->with('success', 'Medical record deleted successfully');
    }
}
