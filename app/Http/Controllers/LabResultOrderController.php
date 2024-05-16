<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Patient;
use App\Models\MedicalRecord;
use App\Models\LabTest;
use App\Models\LabResultOrder;

class LabResultOrderController extends Controller
{
    public function index()
    {
        $labresultorders = LabResultOrder::all();
        return view('backend.lab_result_orders.index', compact('labresultorders'));
    }

    public function create()
    {
        $medicals=MedicalRecord::get();
        $patients=Patient::get();
        $labtests=LabTest::get();
        return view('backend.lab_result_orders.create')
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

        LabResultOrder::create($request->all());

        return redirect()->route('lab_result_orders.index')
            ->with('success', 'Lab result order created successfully.');
    }

    public function show(LabResultOrder $labresultorder)
    {
        return view('backend.lab_result_orders.show', compact('labresultorder'));
    }

    public function edit($id)
    {
        $lab=LabResultOrder::findOrFail($id);
        $medicals=MedicalRecord::get();
        $patients=Patient::get();
        $labtests=LabTest::get();
        return view('backend.lab_result_orders.edit')
            ->with('lab',$lab)
            ->with('medicals',$medicals)
            ->with('patients',$patients)
            ->with('labtests',$labtests);
    }

    public function update(Request $request, LabResultOrder $labresultorder)
    {
        $request->validate([
            'medical_record_id' => 'required|exists:medical_records,id',
            'patient_id' => 'required|exists:patients,id',
            'lab_test_id' => 'required|exists:lab_tests,id',
        ]);

        $labresultorder->update($request->all());

        return redirect()->route('lab_result_orders.index')
            ->with('success', 'Lab result Order updated successfully');
    }

    public function destroy(LabResultOrder $labresultorder)
    {
        $labresultorder->delete();

        return redirect()->route('lab_result_orders.index')
            ->with('success', 'Lab result Order deleted successfully');
    }
}
