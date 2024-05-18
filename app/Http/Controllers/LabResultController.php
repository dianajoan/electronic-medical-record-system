<?php

namespace App\Http\Controllers;

use App\Models\LabResult;
use App\Models\LabTestOrder;
use App\Models\User; // Assuming you have a User model for authenticated_by
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // To get the authenticated user

class LabResultController extends Controller
{
    public function index()
    {
        $labResults = LabResult::all();
        return view('backend.lab_results.index', compact('labResults'));
    }

    public function create()
    {
        $labTestOrders = LabTestOrder::get(); // Get lab test orders for lab_test_order_id field
        $users = User::get(); // Get users for authenticated_by field
        return view('backend.lab_results.create', compact('labTestOrders', 'users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'lab_test_order_id' => 'required|exists:lab_test_orders,id',
            'authenticated_by' => 'required|exists:users,id',
            'result_details' => 'required',
            'result_date' => 'required|date',
            'status' => 'required|in:active,inactive',
        ]);

        $labResult = new LabResult($request->all());
        $labResult->created_by = Auth::id(); // Set created_by to the authenticated user
        $labResult->save();

        return redirect()->route('lab_results.index')
            ->with('success', 'Lab result created successfully.');
    }

    public function show(LabResult $labResult)
    {
        return view('backend.lab_results.show', compact('labResult'));
    }

    public function edit($id)
    {
        $lab = LabResult::findOrFail($id);
        $labTestOrders = LabTestOrder::get(); // Get lab test orders for lab_test_order_id field
        $users = User::get(); // Get users for authenticated_by field
        return view('backend.lab_results.edit', compact('lab', 'labTestOrders', 'users'));
    }

    public function update(Request $request, LabResult $labResult)
    {
        $request->validate([
            'lab_test_order_id' => 'required|exists:lab_test_orders,id',
            'authenticated_by' => 'required|exists:users,id',
            'result_details' => 'required',
            'result_date' => 'required|date',
            'status' => 'required|in:active,inactive',
        ]);

        $labResult->fill($request->all());
        $labResult->updated_by = Auth::id(); // Set updated_by to the authenticated user
        $labResult->save();

        return redirect()->route('lab_results.index')
            ->with('success', 'Lab result updated successfully');
    }

    public function destroy(LabResult $labResult)
    {
        $labResult->deleted_by = Auth::id(); // Set deleted_by to the authenticated user
        $labResult->save();
        $labResult->delete();

        return redirect()->route('lab_results.index')
            ->with('success', 'Lab result deleted successfully');
    }
}
