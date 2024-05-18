<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GeneralTest;

class GeneralTestController extends Controller
{
    public function index()
    {
        $gentests = GeneralTest::all();
        return view('backend.general_tests.index', compact('gentests'));
    }

    public function create()
    {
        return view('backend.general_tests.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:general_tests',
        ]);

        GeneralTest::create($request->all());

        return redirect()->route('general_tests.index')
            ->with('success', 'General Test created successfully.');
    }

    public function show(GeneralTest $gentest)
    {
        return view('backend.general_tests.show', compact('gentest'));
    }

    public function edit(GeneralTest $gentest)
    {
        return view('backend.general_tests.edit', compact('gentest'));
    }

    public function update(Request $request, GeneralTest $gentest)
    {
        $request->validate([
            'name' => 'required|unique:general_tests',
        ]);

        $gentest->update($request->all());

        return redirect()->route('general_tests.index')
            ->with('success', 'General Test updated successfully');
    }

    public function destroy(GeneralTest $gentest)
    {
        $gentest->delete();

        return redirect()->route('backend.general_tests.index')
            ->with('success', 'General Test deleted successfully');
    }
}
