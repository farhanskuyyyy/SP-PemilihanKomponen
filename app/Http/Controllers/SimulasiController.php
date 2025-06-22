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
            ->first();
        $rekomendasi2 = Rule::with(['rsolusi', 'rsolusiRekomendasi'])
            ->inRandomOrder()
            ->first();

        if ($selectedRakitan = $request->id ?? null) {
            $selectedRakitan = Rakitan::find($selectedRakitan);
        }
        return view('simulasi.index', compact('rekomendasi', 'rekomendasi2', 'selectedRakitan'));
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
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

            $validated['code'] = "SIMULASI" . auth()->user()->id . rand(1000, 9999);
            $validated['created_by'] = auth()->user()->id;

            $rakitan = Rakitan::create($validated);
            return response()->json(['success' => true, 'message' => 'Rakitan created successfully.', 'data' => $rakitan]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Failed to create Rakitan.', 'error' => $e->getMessage()], 500);
        }
    }
}
