<?php

namespace App\Http\Controllers;

use App\Models\DrugPrescription;
use App\Models\MedicalRecord;
use App\Models\Patient;
use App\Models\Drug;
use Illuminate\Http\Request;

class DrugPrescriptionController extends Controller
{
    public function index()
    {
        $drugPrescriptions = DrugPrescription::with(['medicalRecord', 'patient', 'drugs'])->get();
        
        // Decode dosage instructions
        $drugPrescriptions->each(function ($drugPrescription) {
            $drugPrescription->dosage_instructions = json_decode($drugPrescription->dosage_instructions, true);
        });

        return view('backend.drug_prescriptions.index', compact('drugPrescriptions'));
    }


    public function create()
    {
        $medicalRecords = MedicalRecord::all();
        $patients = Patient::all();
        $drugs = Drug::all();
        return view('backend.drug_prescriptions.create', compact('medicalRecords', 'patients', 'drugs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'medical_record_id' => 'required|exists:medical_records,id',
            'drug_ids' => 'required|array',
            'drug_ids.*' => 'exists:drugs,id',
            'stock' => 'required|in:in_stock,not_in_stock',
            'dosage_instructions' => 'required|array',
            'dosage_instructions.*.drug_id' => 'required|exists:drugs,id',
            'dosage_instructions.*.instruction' => 'required|string',
            'prescription_date' => 'required|date',
        ]);

        $dosageInstructions = [];
        foreach ($request->dosage_instructions as $instruction) {
            $dosageInstructions[] = [
                'drug_id' => $instruction['drug_id'],
                'instruction' => $instruction['instruction'],
            ];
        }

        $drugPrescription = DrugPrescription::create([
            'patient_id' => $request->patient_id,
            'medical_record_id' => $request->medical_record_id,
            'stock' => $request->stock,
            'dosage_instructions' => json_encode($dosageInstructions),
            'prescription_date' => $request->prescription_date,
            'status' => 'active',
        ]);

        $drugPrescription->drugs()->sync($request->drug_ids);

        return redirect()->route('drug_prescriptions.index')
            ->with('success', 'Drug prescription created successfully.');
    }

    public function show(DrugPrescription $drugPrescription)
    {
        $drugPrescription->load(['medicalRecord', 'patient', 'drugs']);
        return view('backend.drug_prescriptions.show', compact('drugPrescription'));
    }

    public function edit(DrugPrescription $drugPrescription)
    {
        $medicalRecords = MedicalRecord::all();
        $patients = Patient::all();
        $drugs = Drug::all();

        // Decode dosage_instructions to array
        $drugPrescription->dosage_instructions = json_decode($drugPrescription->dosage_instructions, true);

        return view('backend.drug_prescriptions.edit', compact('drugPrescription', 'medicalRecords', 'patients', 'drugs'));
    }

    public function update(Request $request, DrugPrescription $drugPrescription)
    {
        $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'medical_record_id' => 'required|exists:medical_records,id',
            'drug_ids' => 'required|array',
            'drug_ids.*' => 'exists:drugs,id',
            'stock' => 'required|in:in_stock,not_in_stock',
            'prescription_date' => 'required|date',
            'status' => 'required|in:active,inactive',
            'dosage_instructions' => 'required|array',
            'dosage_instructions.*.drug_id' => 'required|exists:drugs,id',
            'dosage_instructions.*.instruction' => 'required|string',
        ]);

        $dosageInstructions = [];
        foreach ($request->dosage_instructions as $instruction) {
            $dosageInstructions[] = [
                'drug_id' => $instruction['drug_id'],
                'instruction' => $instruction['instruction'],
            ];
        }

        $drugPrescription->update([
            'patient_id' => $request->patient_id,
            'medical_record_id' => $request->medical_record_id,
            'stock' => $request->stock,
            'prescription_date' => $request->prescription_date,
            'status' => $request->status,
            'dosage_instructions' => json_encode($dosageInstructions),
        ]);

        $drugPrescription->drugs()->sync($request->drug_ids);

        return redirect()->route('drug_prescriptions.index')
            ->with('success', 'Drug prescription updated successfully.');
    }

    public function destroy(DrugPrescription $drugPrescription)
    {
        $drugPrescription->delete();

        return redirect()->route('drug_prescriptions.index')
            ->with('success', 'Drug prescription deleted successfully.');
    }
}
