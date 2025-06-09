<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Clasification;

class ClasificationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('clasification.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'       => 'required|unique:clasifications,name',
            'pertanyaan' => 'required',
        ]);

        $clasification = Clasification::create($validated);

        return response()->json(['success' => true, 'message' => 'Clasification created successfully.', 'data' => $clasification]);
    }

    /**
     * Show the form for editing the specified resource.
     * Return JSON for modal.
     */
    public function edit(string $id)
    {
        $clasification = Clasification::findOrFail($id);
        return response()->json(['success' => true, 'data' => $clasification]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $clasification = Clasification::findOrFail($id);

        $validated = $request->validate([
            'name'       => 'required|unique:clasifications,name,' . $id,
            'pertanyaan' => 'required',
        ]);

        $clasification->update($validated);

        return response()->json(['success' => true, 'message' => 'Clasification updated successfully.', 'data' => $clasification]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $clasification = Clasification::findOrFail($id);
        $clasification->delete();

        return response()->json(['success' => true, 'message' => 'Clasification deleted successfully.']);
    }

    /**
     * Get data for DataTables via AJAX.
     */
    public function getDataList(Request $request)
    {
        $clasifications = Clasification::select('id', 'name', 'pertanyaan', 'created_at')->get();
        return response()->json(['data' => $clasifications]);
    }
}
