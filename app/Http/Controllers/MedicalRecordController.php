<?php

namespace App\Http\Controllers;

use App\Models\Diagnosis;
use App\Models\MedicalRecord;
use App\Models\Patient;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Middleware\StorePatientId;
use App\Http\Middleware\StoreUserId;

class MedicalRecordController extends Controller
{
    
    public function __construct()
    {
        $this->middleware(StorePatientId::class)->only('store'); // Apply only to store method
        $this->middleware(StoreUserId::class)->only('store'); // Apply only to store method
    }

    public function index()
    {
        $medicalRecords = MedicalRecord::with('patient', 'user', 'secondaryDiagnoses')->get();
        return view('backend.medical_records.index', compact('medicalRecords'));
    }

    public function create(Request $request)
    {
        // Store patient_id and user_id in session if provided
        if ($request->has('patient_id')) {
            session(['patient_id' => $request->patient_id]);
        }

        if ($request->has('user_id')) {
            session(['user_id' => $request->user_id]);
        }

        $patients = Patient::all();
        $users = User::all();
        $diagnoses = Diagnosis::all();

        return view('backend.medical_records.create', compact('patients', 'users', 'diagnoses'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'user_id' => 'required|exists:users,id',
            'visit_date' => 'required|date',
            'primary_diagnosis_id' => 'nullable|exists:diagnoses,id',
            'secondary_diagnoses' => 'nullable|array',
            'secondary_diagnoses.*' => 'exists:diagnoses,id',
            'symptoms' => 'required|string',
            'treatment_given' => 'required|string',
            'outcome' => 'required|in:admitted,died,referred,discharged',
            'status' => 'nullable|in:active,inactive',
        ]);

        try {
            $medicalRecord = new MedicalRecord();
            $medicalRecord->patient_id = $request->patient_id;
            $medicalRecord->user_id = $request->user_id;
            $medicalRecord->visit_date = $request->visit_date;
            $medicalRecord->primary_diagnosis_id = $request->primary_diagnosis_id;
            $medicalRecord->symptoms = $request->symptoms;
            $medicalRecord->treatment_given = $request->treatment_given;
            $medicalRecord->outcome = $request->outcome;
            $medicalRecord->status = $request->status ?? 'inactive'; // Default status
            $medicalRecord->created_by = auth()->id();

            $medicalRecord->save();

            if ($request->has('secondary_diagnoses')) {
                $medicalRecord->secondaryDiagnoses()->sync($request->secondary_diagnoses);
            }

            // Clear patient and user session
            session()->forget(['patient_id', 'user_id']);

            return redirect()->route('medical_records.index')
                ->with('success', 'Medical record created successfully.');
        } catch (\Exception $e) {
            \Log::error('Error creating medical record: ' . $e->getMessage());
            return back()->withErrors(['error' => 'There was a problem creating the medical record.']);
        }
    }

    public function show(MedicalRecord $medicalRecord)
    {
        $medicalRecord->load('patient', 'user', 'secondaryDiagnoses');
        return view('backend.medical_records.show', compact('medicalRecord'));
    }

    public function edit(MedicalRecord $medical_record)
    {
        $patients = Patient::all();
        $users = User::all();
        $diagnoses = Diagnosis::all();
        $medical_record->load('secondaryDiagnoses'); // Load the secondary diagnoses for editing
        return view('backend.medical_records.edit', compact('medical_record', 'patients', 'users', 'diagnoses'));
    }

    public function update(Request $request, MedicalRecord $medical_record)
    {
        $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'user_id' => 'required|exists:users,id',
            'visit_date' => 'required|date',
            'primary_diagnosis_id' => 'nullable|exists:diagnoses,id',
            'secondary_diagnoses' => 'nullable|array',
            'secondary_diagnoses.*' => 'exists:diagnoses,id',
            'symptoms' => 'required|string',
            'treatment_given' => 'required|string',
            'outcome' => 'required|in:admitted,died,referred,discharged',
            'status' => 'nullable|in:active,inactive',
            'created_by' => 'nullable|exists:users,id',
            'updated_by' => 'nullable|exists:users,id',
            'deleted_by' => 'nullable|exists:users,id',
        ]);

        $medical_record->patient_id = $request->patient_id;
        $medical_record->user_id = $request->user_id;
        $medical_record->visit_date = $request->visit_date;
        $medical_record->primary_diagnosis_id = $request->primary_diagnosis_id;
        $medical_record->symptoms = $request->symptoms;
        $medical_record->treatment_given = $request->treatment_given;
        $medical_record->outcome = $request->outcome;
        $medical_record->status = $request->status;
        $medical_record->updated_by = auth()->id(); // Assuming you are using authentication

        $medical_record->save();

        if ($request->has('secondary_diagnoses')) {
            $medical_record->secondaryDiagnoses()->sync($request->secondary_diagnoses);
        }

        return redirect()->route('medical_records.index')
            ->with('success', 'Medical record updated successfully.');
    }

    public function destroy(MedicalRecord $medical_record)
    {
        $medical_record->delete();

        return redirect()->route('medical_records.index')
            ->with('success', 'Medical record deleted successfully.');
    }
}
