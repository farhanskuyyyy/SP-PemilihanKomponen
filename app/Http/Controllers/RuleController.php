<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Clasification;
use App\Models\Rakitan;
use Illuminate\Http\Request;
use App\Models\Rule;

class RuleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rakitans = Rakitan::all();
        $clasifications = Clasification::with('categories')->get();
        return view('rule.index', compact('rakitans', 'clasifications'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $categories = $request->input('categories', []);
        $validated = $request->validate([
            'description'             => 'required',
            'solusi'                  => 'required|integer|exists:rakitan,id',
            'solusi_rekomendasi'      => 'nullable|integer|exists:rakitan,id',
            'description_rekomendasi' => 'nullable',
        ]);

        $rule = Rule::create($validated);
        if (!empty($categories)) {
            $rule->categories()->sync($categories);
        }

        return response()->json(['success' => true, 'message' => 'Rule created successfully.', 'data' => $rule]);
    }

    /**
     * Show the form for editing the specified resource.
     * Return JSON for modal.
     */
    public function edit(string $id)
    {
        $rule = Rule::findOrFail($id);
        return response()->json(['success' => true, 'data' => $rule]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $rule = Rule::findOrFail($id);

        $categories = $request->input('categories', []);
        $validated = $request->validate([
            'description'             => 'required',
            'solusi'                  => 'required|integer|exists:rakitan,id',
            'solusi_rekomendasi'      => 'nullable|integer|exists:rakitan,id',
            'description_rekomendasi' => 'nullable',
        ]);

        $rule->update($validated);
        if (!empty($categories)) {
            $rule->categories()->sync($categories);
        }

        return response()->json(['success' => true, 'message' => 'Rule updated successfully.', 'data' => $rule]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $rule = Rule::findOrFail($id);
        $rule->delete();

        return response()->json(['success' => true, 'message' => 'Rule deleted successfully.']);
    }

    /**
     * Get data for DataTables via AJAX.
     */
    public function getDataList(Request $request)
    {
        $rules = Rule::with([
            'categories',
            'rsolusi',
            'rsolusiRekomendasi'
        ])->get()->map(function ($rule) {
            return [
                'id' => $rule->id,
                'description' => $rule->description,
                'category_ids' => $rule->categories->pluck('id'),
                'category_codes' => $rule->categories->pluck('code'),
                'solusi' => $rule->rsolusi,
                'solusi_rekomendasi' => $rule->rsolusiRekomendasi,
                'description_rekomendasi' => $rule->description_rekomendasi,
                'created_at' => $rule->created_at,
                'updated_at' => $rule->updated_at,
            ];
        });
        return response()->json(['data' => $rules]);
    }
}
