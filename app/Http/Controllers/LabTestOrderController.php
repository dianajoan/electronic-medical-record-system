<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\MedicalRecord;
use App\Models\GeneralTest;
use App\Models\LabTestOrder;

class LabTestOrderController extends Controller
{
    public function index()
    {
        $labtestorders = LabTestOrder::with(['medicalRecord', 'genTest', 'orderedByUser'])->get();
        return view('backend.lab_test_orders.index', compact('labtestorders'));
    }

    public function create()
    {
        $medicalRecords = MedicalRecord::get();
        $users = User::get();
        $genTests = GeneralTest::get();
        return view('backend.lab_test_orders.create', compact('medicalRecords', 'users', 'genTests'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'medical_record_id' => 'required|exists:medical_records,id',
            'ordered_by' => 'required|exists:users,id',
            'general_test_id' => 'required|exists:general_tests,id',
            'test_name' => 'required',
            'status' => 'required|in:active,inactive',
        ]);

        $labTestOrder = new LabTestOrder();
        $labTestOrder->medical_record_id = $request->input('medical_record_id');
        $labTestOrder->ordered_by = $request->input('ordered_by');
        $labTestOrder->general_test_id = $request->input('general_test_id');
        $labTestOrder->test_name = $request->input('test_name');
        $labTestOrder->status = $request->input('status');
        $labTestOrder->save();

        return redirect()->route('lab_test_orders.index')
            ->with('success', 'Lab test order created successfully.');
    }

    public function show(LabTestOrder $lab_test_order)
    {
        $lab_test_order->load(['medicalRecord', 'genTest', 'orderedByUser']);
        return view('backend.lab_test_orders.show', compact('lab_test_order'));
    }

    public function edit(LabTestOrder $lab_test_order)
    {
        $medicalRecords = MedicalRecord::get();
        $users = User::get();
        $genTests = GeneralTest::get();
        return view('backend.lab_test_orders.edit', compact('lab_test_order', 'medicalRecords', 'users', 'genTests'));
    }

    public function update(Request $request, LabTestOrder $lab_test_order)
    {
        $request->validate([
            'medical_record_id' => 'required|exists:medical_records,id',
            'ordered_by' => 'required|exists:users,id',
            'general_test_id' => 'required|exists:general_tests,id',
            'test_name' => 'required',
            'status' => 'required|in:active,inactive',
        ]);

        $lab_test_order->medical_record_id = $request->input('medical_record_id');
        $lab_test_order->ordered_by = $request->input('ordered_by');
        $lab_test_order->general_test_id = $request->input('general_test_id');
        $lab_test_order->test_name = $request->input('test_name');
        $lab_test_order->status = $request->input('status');
        $lab_test_order->save();

        return redirect()->route('lab_test_orders.index')
            ->with('success', 'Lab test order updated successfully.');
    }

    public function destroy(LabTestOrder $lab_test_order)
    {
        $lab_test_order->delete();

        return redirect()->route('lab_test_orders.index')
            ->with('success', 'Lab test order deleted successfully.');
    }
}
