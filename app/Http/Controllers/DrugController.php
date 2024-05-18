<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Drug;

class DrugController extends Controller
{
    public function index()
    {
        $drugs = Drug::all();
        return view('backend.drugs.index', compact('drugs'));
    }

    public function create()
    {
        return view('backend.drugs.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:drugs',
            'brand_name' => 'required',
            'form' => 'required',
            'code' => 'required',
            // Add validation for other fields if necessary
        ]);

        Drug::create($request->all());

        return redirect()->route('drugs.index')
            ->with('success', 'Drug created successfully.');
    }

    public function show(Drug $drug)
    {
        return view('backend.drugs.show', compact('drug'));
    }

    public function edit($id)
    {
        $drug=Drug::findOrFail($id);
        return view('backend.drugs.edit')
            ->with('drug',$drug);
    }

    public function update(Request $request, Drug $drug)
    {
        $request->validate([
            'name' => 'required|unique:drugs',
            'brand_name' => 'required',
            'form' => 'required',
            'code' => 'required',
            // Add validation for other fields if necessary
        ]);

        $drug->update($request->all());

        return redirect()->route('drugs.index')
            ->with('success', 'Drug updated successfully');
    }

    public function destroy(Drug $drug)
    {
        $drug->delete();

        return redirect()->route('drugs.index')
            ->with('success', 'Drug deleted successfully');
    }
}
