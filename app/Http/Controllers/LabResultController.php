<?php

namespace App\Http\Controllers;

use App\Models\LabResult;
use App\Models\MedicalRecord;
use App\Models\Patient;
use Illuminate\Http\Request;

class LabResultController extends Controller
{
    public function index()
    {
        $labResults = LabResult::all();
        return view('backend.lab_results.index', compact('labResults'));
    }

    public function create()
    {
        $medicals=MedicalRecord::get();
        $patients=Patient::get();
        return view('backend.lab_results.create')
            ->with('medicals',$medicals)
            ->with('patients',$patients);
    }

    public function store(Request $request)
    {
        $request->validate([
            'medical_record_id' => 'required|exists:medical_records,id',
            'patient_id' => 'required|exists:patients,id',
            'test_name' => 'required',
            'result_details' => 'required',
            'result_date' => 'required|date',
        ]);

        LabResult::create($request->all());

        return redirect()->route('lab_results.index')
            ->with('success', 'Lab result created successfully.');
    }

    public function show(LabResult $labResult)
    {
        return view('backend.lab_results.show', compact('labResult'));
    }

    public function edit($id)
    {
        $lab=LabResult::findOrFail($id);
        $medicals=MedicalRecord::get();
        $patients=Patient::get();
        return view('backend.lab_results.edit')
            ->with('lab',$lab)
            ->with('medicals',$medicals)
            ->with('patients',$patients);
    }

    public function update(Request $request, LabResult $labResult)
    {
        $request->validate([
            'medical_record_id' => 'required|exists:medical_records,id',
            'patient_id' => 'required|exists:patients,id',
            'test_name' => 'required',
            'result_details' => 'required',
            'result_date' => 'required|date',
        ]);

        $labResult->update($request->all());

        return redirect()->route('lab_results.index')
            ->with('success', 'Lab result updated successfully');
    }

    public function destroy(LabResult $labResult)
    {
        $labResult->delete();

        return redirect()->route('lab_results.index')
            ->with('success', 'Lab result deleted successfully');
    }
}
