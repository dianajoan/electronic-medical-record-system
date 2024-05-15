<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\LabTest;

class LabTestController extends Controller
{
    public function index()
    {
        $labtests = LabTest::all();
        return view('backend.lab_tests.index', compact('labtests'));
    }

    public function create()
    {
        return view('backend.lab_tests.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:lab_tests',
            'duration' => 'required|date',
        ]);

        LabTest::create($request->all());

        return redirect()->route('lab_tests.index')
            ->with('success', 'Lab Test created successfully.');
    }

    public function show(LabTest $labtest)
    {
        return view('backend.lab_tests.show', compact('labtest'));
    }

    public function edit(LabTest $labtest)
    {
        return view('backend.lab_tests.edit', compact('labtest'));
    }

    public function update(Request $request, LabTest $labtest)
    {
        $request->validate([
            'name' => 'required|unique:lab_tests',
            'duration' => 'required|date',
        ]);

        $labtest->update($request->all());

        return redirect()->route('lab_tests.index')
            ->with('success', 'Lab Test updated successfully');
    }

    public function destroy(LabTest $labtest)
    {
        $labtest->delete();

        return redirect()->route('backend.lab_tests.index')
            ->with('success', 'Lab Test deleted successfully');
    }
}
