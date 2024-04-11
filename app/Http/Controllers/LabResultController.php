<?php

namespace App\Http\Controllers;

use App\Models\LabResult;
use Illuminate\Http\Request;

class LabResultController extends Controller
{
    public function index()
    {
        $labResults = LabResult::all();
        return view('lab_results.index', compact('labResults'));
    }

    public function create()
    {
        return view('lab_results.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'medical_record_id' => 'required|exists:medical_records,id',
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
        return view('lab_results.show', compact('labResult'));
    }

    public function edit(LabResult $labResult)
    {
        return view('lab_results.edit', compact('labResult'));
    }

    public function update(Request $request, LabResult $labResult)
    {
        $request->validate([
            'medical_record_id' => 'required|exists:medical_records,id',
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
