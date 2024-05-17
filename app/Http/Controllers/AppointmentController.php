<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\Patient;
use App\Models\MedicalRecord;
use App\Models\Clinic;

class AppointmentController extends Controller
{
    public function index()
    {
        $appointments = Appointment::all();
        return view('backend.appointments.index', compact('appointments'));
    }

    public function create()
    {
        $patients=Patient::get();
        $medicals=MedicalRecord::get();
        $clinics=Clinic::get();
        return view('backend.appointments.create')
            ->with('patients',$patients)
            ->with('medicals',$medicals)
            ->with('clinics',$clinics);
    }

    public function store(Request $request)
    {
        $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'medical_record_id' => 'required|exists:medical_records,id',
            'clinic_id' => 'required|exists:clinics,id',
            'name' => 'required',
            'date' => 'required|date',
            'time' => 'required',
            'status' => 'required',
            // Add validation for other fields if necessary
        ]);

        Appointment::create($request->all());

        return redirect()->route('appointments.index')
            ->with('success', 'Appointment created successfully.');
    }

    public function show(Appointment $appointment)
    {
        return view('backend.appointments.show', compact('appointment'));
    }

    public function edit($id)
    {
        $appointment=Appointment::findOrFail($id);
        $patients=Patient::get();
        $medicals=MedicalRecord::get();
        $clinics=Clinic::get();
        return view('backend.appointments.edit')
        ->with('appointment',$appointment)
        ->with('patients',$patients)
        ->with('medicals',$medicals)
        ->with('clinics',$clinics);
    }

    public function update(Request $request, Appointment $appointment)
    {
        $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'medical_record_id' => 'required|exists:medical_records,id',
            'clinic_id' => 'required|exists:clinics,id',
            'name' => 'required',
            'date' => 'required|date',
            'time' => 'required',
            'status' => 'required',
            // Add validation for other fields if necessary
        ]);

        $appointment->update($request->all());

        return redirect()->route('appointments.index')
            ->with('success', 'Appointment updated successfully');
    }

    public function destroy(Appointment $appointment)
    {
        $appointment->delete();

        return redirect()->route('appointments.index')
            ->with('success', 'Appointment deleted successfully');
    }
}
