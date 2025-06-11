<?php

namespace App\Http\Controllers;

use App\Models\Clasification;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clasifications = Clasification::get();
        return view('category.index', compact('clasifications'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'code'            => 'required|unique:categories,code',
            'name'            => 'required|string',
            'value'           => 'required',
            'clasification_id'=> 'required|exists:clasifications,id',
        ]);

        $category = Category::create($validated);

        return response()->json(['success' => true, 'message' => 'Category created successfully.', 'data' => $category]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category = Category::findOrFail($id);
        return response()->json(['success' => true, 'data' => $category]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $category = Category::findOrFail($id);

        $validated = $request->validate([
            'code'            => 'required|unique:categories,code,' . $id,
            'name'            => 'required|string',
            'value'           => 'required',
            'clasification_id'=> 'required|exists:clasifications,id',
        ]);

        $validated['is_active'] = $request->has('is_active') ? (bool)$request->input('is_active') : false;
        $category->update($validated);

        return response()->json(['success' => true, 'message' => 'Category updated successfully.', 'data' => $category]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return response()->json(['success' => true, 'message' => 'Category deleted successfully.']);
    }

    /**
     * Get data for DataTables via AJAX.
     */
    public function getDataList(Request $request)
    {
        $categories = Category::with('clasification')->get();
        return response()->json(['data' => $categories]);
    }
}
