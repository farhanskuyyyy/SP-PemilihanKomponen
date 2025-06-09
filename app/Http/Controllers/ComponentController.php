<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Component;
use App\Models\ComponentType;

class ComponentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $types = ComponentType::get();
        return view('component.index', compact('types'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'code'        => 'required|unique:components,code',
            'component_type_id'     => 'required|exists:component_types,id',
            'name' => 'required|string',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string',
        ]);

        $component = Component::create($validated);

        return response()->json(['success' => true, 'message' => 'Component created successfully.', 'data' => $component]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $component = Component::findOrFail($id);
        return response()->json(['success' => true, 'data' => $component]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $component = Component::findOrFail($id);

        $validated = $request->validate([
            'code'        => 'required|unique:components,code,' . $id,
            'component_type_id'     => 'required|exists:component_types,id',
            'name' => 'required|string',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string',
        ]);

        $validated['is_active'] = $request->has('is_active') ? (bool)$request->input('is_active') : false;
        $component->update($validated);

        return response()->json(['success' => true, 'message' => 'Component updated successfully.', 'data' => $component]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $component = Component::findOrFail($id);
        $component->delete();

        return response()->json(['success' => true, 'message' => 'Component deleted successfully.']);
    }

    /**
     * Get data for DataTables via AJAX.
     */
    public function getDataList(Request $request)
    {
        $components = Component::with('type')->get();
        return response()->json(['data' => $components]);
    }
}
