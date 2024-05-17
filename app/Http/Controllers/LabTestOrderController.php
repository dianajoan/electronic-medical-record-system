<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Patient;
use App\Models\MedicalRecord;
use App\Models\LabTest;
use App\Models\LabTestOrder;

class LabTestOrderController extends Controller
{
    public function index()
    {
        $labtestorders = LabTestOrder::all();
        return view('backend.lab_test_orders.index', compact('labtestorders'));
    }

    public function create()
    {
        $medicals=MedicalRecord::get();
        $patients=Patient::get();
        $labtests=LabTest::get();
        return view('backend.lab_test_orders.create')
            ->with('medicals',$medicals)
            ->with('patients',$patients)
            ->with('labtests',$labtests);
    }

    public function store(Request $request)
    {
        $request->validate([
            'medical_record_id' => 'required|exists:medical_records,id',
            'patient_id' => 'required|exists:patients,id',
            'lab_test_id' => 'required|exists:lab_tests,id',
        ]);

        LabTestOrder::create($request->all());

        return redirect()->route('lab_test_orders.index')
            ->with('success', 'Lab test order created successfully.');
    }

    public function show(LabTestOrder $labtestorder)
    {
        return view('backend.lab_test_orders.show', compact('labtestorder'));
    }

    public function edit($id)
    {
        $labto=LabTestOrder::findOrFail($id);
        $medicals=MedicalRecord::get();
        $patients=Patient::get();
        $labtests=LabTest::get();
        return view('backend.lab_test_orders.edit')
            ->with('labto',$labto)
            ->with('medicals',$medicals)
            ->with('patients',$patients)
            ->with('labtests',$labtests);
    }

    public function update(Request $request, LabTestOrder $labtestorder)
    {
        $request->validate([
            'medical_record_id' => 'required|exists:medical_records,id',
            'patient_id' => 'required|exists:patients,id',
            'lab_test_id' => 'required|exists:lab_tests,id',
        ]);

        $labtestorder->update($request->all());

        return redirect()->route('lab_test_orders.index')
            ->with('success', 'Lab test Order updated successfully');
    }

    public function destroy(LabTestOrder $labtestorder)
    {
        $labtestorder->delete();

        return redirect()->route('lab_test_orders.index')
            ->with('success', 'Lab test Order deleted successfully');
    }
}
