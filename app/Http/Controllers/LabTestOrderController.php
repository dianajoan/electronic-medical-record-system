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
        return view('backend.lab_ordered_tests.index', compact('labtestorders'));
    }

    public function create()
    {
        $medicals=MedicalRecord::get();
        $patients=Patient::get();
        $labtests=LabTest::get();
        return view('backend.lab_ordered_tests.create')
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

        return redirect()->route('lab_ordered_tests.index')
            ->with('success', 'Lab test order created successfully.');
    }

    public function show(LabTestOrder $labtestorder)
    {
        return view('backend.lab_ordered_tests.show', compact('labtestorder'));
    }

    public function edit($id)
    {
        $lab=LabTestOrder::findOrFail($id);
        $medicals=MedicalRecord::get();
        $patients=Patient::get();
        $labtests=LabTest::get();
        return view('backend.lab_ordered_tests.edit')
            ->with('lab',$lab)
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

        return redirect()->route('lab_ordered_tests.index')
            ->with('success', 'Lab test Order updated successfully');
    }

    public function destroy(LabTestOrder $labtestorder)
    {
        $labtestorder->delete();

        return redirect()->route('lab_ordered_tests.index')
            ->with('success', 'Lab test Order deleted successfully');
    }
}
