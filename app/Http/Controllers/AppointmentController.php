<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\Patient;
use App\Models\MedicalRecord;
use App\Models\Clinic;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AppointmentController extends Controller
{
    public function index()
    {
        $appointments = Appointment::all();
        return view('backend.appointments.index', compact('appointments'));
    }

    public function create()
    {
        $patients = Patient::all();
        $medicalRecords = MedicalRecord::all();
        $clinics = Clinic::all();
        $users = User::all();
        return view('backend.appointments.create', compact('patients', 'medicalRecords', 'clinics', 'users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'clinical_notes' => 'nullable|string',
            'appointment_date' => 'required|date',
            'patient_id' => 'required|exists:patients,id',
            'medical_record_id' => 'required|exists:medical_records,id',
            'clinic_id' => 'required|exists:clinics,id',
            'status' => 'required|string|max:255',
        ]);

        $appointment = new Appointment($request->all());
        $appointment->authenticated_by = Auth::id();
        $appointment->save();

        return redirect()->route('appointments.index')
            ->with('success', 'Appointment created successfully.');
    }

    public function show(Appointment $appointment)
    {
        return view('backend.appointments.show', compact('appointment'));
    }

    public function edit(Appointment $appointment)
    {
        $patients = Patient::all();
        $medicalRecords = MedicalRecord::all();
        $clinics = Clinic::all();
        $users = User::all();
        return view('backend.appointments.edit', compact('appointment', 'patients', 'medicalRecords', 'clinics', 'users'));
    }

    public function update(Request $request, Appointment $appointment)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'clinical_notes' => 'nullable|string',
            'appointment_date' => 'required|date',
            'patient_id' => 'required|exists:patients,id',
            'medical_record_id' => 'required|exists:medical_records,id',
            'clinic_id' => 'required|exists:clinics,id',
            'status' => 'required|string|max:255',
        ]);

        $appointment->update($request->all());
        $appointment->authenticated_by = Auth::id();
        $appointment->save();

        return redirect()->route('appointments.index')
            ->with('success', 'Appointment updated successfully.');
    }

    public function destroy(Appointment $appointment)
    {
        $appointment->delete();

        return redirect()->route('appointments.index')
            ->with('success', 'Appointment deleted successfully.');
    }
}
