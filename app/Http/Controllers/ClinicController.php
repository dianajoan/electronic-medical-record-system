<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Clinic;

class ClinicController extends Controller
{
    public function index()
    {
        $clinics = Clinic::all();
        return view('backend.clinics.index', compact('clinics'));
    }

    public function create()
    {
        return view('backend.clinics.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:clinics',
        ]);

        Clinic::create($request->all());

        return redirect()->route('clinics.index')
            ->with('success', 'Clinic created successfully.');
    }

    public function show(Clinic $clinic)
    {
        return view('backend.clinics.show', compact('clinic'));
    }

    public function edit(Clinic $clinic)
    {
        return view('backend.clinics.edit', compact('clinic'));
    }

    public function update(Request $request, Clinic $clinic)
    {
        $request->validate([
            'name' => 'required|unique:clinics',
        ]);

        $clinic->update($request->all());

        return redirect()->route('lab_tests.index')
            ->with('success', 'Clinic updated successfully');
    }

    public function destroy(Clinic $clinic)
    {
        $clinic->delete();

        return redirect()->route('backend.clinics.index')
            ->with('success', 'Clinic deleted successfully');
    }
}
