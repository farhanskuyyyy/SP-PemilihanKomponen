<?php

namespace App\Http\Controllers;

use App\Models\Component;
use Illuminate\Http\Request;
use App\Models\Rakitan;

class RakitanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $components = Component::all();
        return view('rakitan.index', compact('components'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'code'              => 'required|unique:rakitan,code|max:100',
            'name'              => 'required|max:255',
            'motherboard'       => 'required|exists:components,id',
            'processor'         => 'required|exists:components,id',
            'ram'               => 'required|exists:components,id',
            'casing'            => 'required|exists:components,id',
            'storage_primary'   => 'required|exists:components,id',
            'storage_secondary' => 'nullable|exists:components,id',
            'vga'               => 'required|exists:components,id',
            'psu'               => 'required|exists:components,id',
            'monitor'           => 'required|exists:components,id',
        ]);

        $validated['created_by'] = auth()->user()->id;

        $rakitan = Rakitan::create($validated);

        return response()->json(['success' => true, 'message' => 'Rakitan created successfully.', 'data' => $rakitan]);
    }

    /**
     * Show the form for editing the specified resource.
     * Return JSON for modal.
     */
    public function edit(string $id)
    {
        $rakitan = Rakitan::findOrFail($id);
        return response()->json(['success' => true, 'data' => $rakitan]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $rakitan = Rakitan::findOrFail($id);

        $validated = $request->validate([
            'code'              => 'required|max:100|unique:rakitan,code,' . $id,
            'name'              => 'required|max:255',
            'motherboard'       => 'required|exists:components,id',
            'processor'         => 'required|exists:components,id',
            'ram'               => 'required|exists:components,id',
            'casing'            => 'required|exists:components,id',
            'storage_primary'   => 'required|exists:components,id',
            'storage_secondary' => 'nullable|exists:components,id',
            'vga'               => 'required|exists:components,id',
            'psu'               => 'required|exists:components,id',
            'monitor'           => 'required|exists:components,id',
        ]);

        $validated['created_by'] = auth()->user()->id;

        $rakitan->update($validated);

        return response()->json(['success' => true, 'message' => 'Rakitan updated successfully.', 'data' => $rakitan]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $rakitan = Rakitan::findOrFail($id);
        $rakitan->delete();

        return response()->json(['success' => true, 'message' => 'Rakitan deleted successfully.']);
    }

    /**
     * Get data for DataTables via AJAX.
     */
    public function getDataList(Request $request)
    {
        $rakitans = Rakitan::with([
            'motherboard',
            'processor',
            'ram',
            'casing',
            'storagePrimary',
            'storageSecondary',
            'vga',
            'psu',
            'monitor',
            'creator',
        ])->get();
        return response()->json(['data' => $rakitans]);
    }
}
