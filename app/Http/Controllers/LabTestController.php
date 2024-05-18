<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\LabTest;
use App\Models\MedicalRecord;
use App\Models\User;

class LabTestController extends Controller
{
    public function index()
    {
        $labtests = LabTest::all();
        return view('backend.lab_tests.index', compact('labtests'));
    }

    public function create()
{
    $medicalRecords = MedicalRecord::all();
    $users = User::all();
    return view('backend.lab_tests.create', compact('medicalRecords', 'users'));
}


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:lab_tests',
            'duration' => 'required',
            'medical_record_id' => 'required|exists:medical_records,id',
            'authenticated_by' => 'required|exists:users,id',
            'status' => 'required|in:active,inactive',
        ]);

        LabTest::create($request->all());

        return redirect()->route('lab_tests.index')
            ->with('success', 'Lab Test created successfully.');
    }

    public function show(LabTest $lab_test)
    {
        $lab_test->load(['medicalRecord', 'user']);
        return view('backend.lab_tests.show', compact('lab_test'));
    }

    public function edit(LabTest $lab_test)
    {
        $medicalRecords = MedicalRecord::all();
        $users = User::all();
        return view('backend.lab_tests.edit', compact('medicalRecords', 'users', 'lab_test'));
    }

    public function update(Request $request, LabTest $lab_test)
    {
        $request->validate([
            'name' => 'required|unique:lab_tests,name,' . $lab_test->id,
            'duration' => 'required',
            'medical_record_id' => 'required|exists:medical_records,id',
            'authenticated_by' => 'required|exists:users,id',
            'status' => 'required|in:active,inactive',
        ]);

        $lab_test->update($request->all());

        return redirect()->route('lab_tests.index')
            ->with('success', 'Lab Test updated successfully');
    }

    public function destroy(LabTest $lab_test)
    {
        $labtest->delete();

        return redirect()->route('lab_tests.index')
            ->with('success', 'Lab Test deleted successfully');
    }
}
