<?php

namespace App\Http\Controllers;

use App\Models\Clasification;
use App\Models\Rakitan;
use App\Models\Rule;
use Illuminate\Http\Request;

class KonsultasiController extends Controller
{
    public function index()
    {
        $clasifications = Clasification::with('categories')->get();
        return view('konsultasi.index', compact('clasifications'));
    }

    public function store(Request $request)
    {
        try {
            $rule = Rule::with(['rsolusi','rsolusiRekomendasi'])->first();
            return response()->json(['success' => true, 'message' => 'Hasil Konsultasi Ditemukan.', 'data' => $rule]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Failed to Konsultasi.', 'error' => $e->getMessage()], 500);
        }
    }
}
