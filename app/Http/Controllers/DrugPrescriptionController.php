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
        $drugPrescriptions = DrugPrescription::all();
        return view('backend.drug_prescriptions.index', compact('drugPrescriptions'));
    }

    public function create()
    {
        $medicals=MedicalRecord::get();
        $patients=Patient::get();
        $drugs=Drug::get();
        return view('backend.drug_prescriptions.create')
            ->with('medicals',$medicals)
            ->with('patients',$patients)
            ->with('drugs',$drugs);
    }

    public function store(Request $request)
    {
        $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'medical_record_id' => 'required|exists:medical_records,id',
            'drug_id' => 'required|exists:drugs,id',
            'stock'=>'sometimes|in:1',
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

    public function edit($id)
    {
        $drug=DrugPrescription::findOrFail($id);
        $medicals=MedicalRecord::get();
        return view('backend.drug_prescriptions.edit')
            ->with('drug',$drug)
            ->with('medicals',$medicals);
    }

    public function update(Request $request, DrugPrescription $drugPrescription)
    {
        $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'medical_record_id' => 'required|exists:medical_records,id',
            'drug_id' => 'required|exists:drugs,id',
            'stock'=>'sometimes|in:1',
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
