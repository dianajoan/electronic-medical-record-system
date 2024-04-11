<?php

namespace App\Http\Controllers;

use App\Models\DrugPrescription;
use Illuminate\Http\Request;

class DrugPrescriptionController extends Controller
{
    public function index()
    {
        $drugPrescriptions = DrugPrescription::all();
        return view('backend.drug_prescriptions.index', compact('drugPrescriptions'));
    }

    public function create()
    {
        return view('backend.drug_prescriptions.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'medical_record_id' => 'required|exists:medical_records,id',
            'drug_name' => 'required',
            'dosage_instructions' => 'required',
            'prescription_date' => 'required|date',
        ]);

        DrugPrescription::create($request->all());

        return redirect()->route('drug_prescriptions.index')
            ->with('success', 'Drug prescription created successfully.');
    }

    public function show(DrugPrescription $drugPrescription)
    {
        return view('backend.drug_prescriptions.show', compact('drugPrescription'));
    }

    public function edit(DrugPrescription $drugPrescription)
    {
        return view('backend.drug_prescriptions.edit', compact('drugPrescription'));
    }

    public function update(Request $request, DrugPrescription $drugPrescription)
    {
        $request->validate([
            'medical_record_id' => 'required|exists:medical_records,id',
            'drug_name' => 'required',
            'dosage_instructions' => 'required',
            'prescription_date' => 'required|date',
        ]);

        $drugPrescription->update($request->all());

        return redirect()->route('drug_prescriptions.index')
            ->with('success', 'Drug prescription updated successfully');
    }

    public function destroy(DrugPrescription $drugPrescription)
    {
        $drugPrescription->delete();

        return redirect()->route('drug_prescriptions.index')
            ->with('success', 'Drug prescription deleted successfully');
    }
}
