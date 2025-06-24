<?php

namespace App\Http\Controllers;

use App\Models\Rakitan;
use App\Models\Rule;
use Illuminate\Http\Request;

class SimulasiController extends Controller
{
    public function index(Request $request)
    {
        $rekomendasi = Rule::with(['rsolusi', 'rsolusiRekomendasi'])
            ->inRandomOrder()
            ->limit(2)
            ->get();

        if ($selectedRakitan = $request->id ?? null) {
            $selectedRakitan = Rakitan::find($selectedRakitan);
        }
        $rakitanLists = Rakitan::where('created_by', auth()->user()->id)
            ->orderBy('created_at', 'desc')
            ->get();
        return view('simulasi.index', compact('rekomendasi', 'selectedRakitan', 'rakitanLists'));
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'id'                => 'nullable|exists:rakitan,id',
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

            // If an ID is provided, update the existing Rakitan
            if (isset($validated['id'])) {
                $rakitan = Rakitan::find($validated['id']);
                if ($rakitan && $rakitan->created_by == auth()->user()->id) {
                    $rakitan->update($validated);
                    return response()->json(['success' => true, 'message' => 'Rakitan updated successfully.', 'data' => $rakitan, 'url' => route('rakitan.print', ['code' => $rakitan->code])]);
                }
            }

            $validated['code'] = "SIMULASI" . auth()->user()->id . rand(1000, 9999);
            $validated['created_by'] = auth()->user()->id;

            $rakitan = Rakitan::create($validated);
            return response()->json(['success' => true, 'message' => 'Rakitan created successfully.', 'data' => $rakitan, 'url' => route('rakitan.print', ['code' => $rakitan->code])]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Failed to create Rakitan.', 'error' => $e->getMessage()], 500);
        }
    }
}
