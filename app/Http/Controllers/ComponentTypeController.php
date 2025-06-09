<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ComponentType;

class ComponentTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     * Pass role enum for select options to the view.
     */
    public function index()
    {
        return view('componentType.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'    => 'required|unique:component_types,name',
        ]);

        $componentType = ComponentType::create($validated);

        return response()->json(['success' => true, 'message' => 'ComponentType created successfully.', 'data' => $componentType]);
    }

    /**
     * Show the form for editing the specified resource.
     * Return JSON for modal.
     */
    public function edit(string $id)
    {
        $componentType = ComponentType::findOrFail($id);
        return response()->json(['success' => true, 'data' => $componentType]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $componentType = ComponentType::findOrFail($id);

        $validated = $request->validate([
            'name'    => 'required|unique:component_types,name,' . $id,
        ]);

        $componentType->update($validated);

        return response()->json(['success' => true, 'message' => 'ComponentType updated successfully.', 'data' => $componentType]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $componentType = ComponentType::findOrFail($id);
        $componentType->delete();

        return response()->json(['success' => true, 'message' => 'ComponentType deleted successfully.']);
    }

    /**
     * Get data for DataTables via AJAX.
     */
    public function getDataList(Request $request)
    {
        $users = ComponentType::select('id', 'name', 'created_at')->get();
        return response()->json(['data' => $users]);
    }
}
