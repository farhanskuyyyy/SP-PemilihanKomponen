<?php

namespace App\Http\Controllers;

use App\Models\Clasification;
use App\Models\Rakitan;
use App\Models\Rule;
use Exception;
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
            $categories = $request->input('categories');
            $rule = $this->ruleBased($categories);
            if ($rule == null) {
                throw new Exception("Rakitan Tidak Ditemukan");
            }
            return response()->json(['success' => true, 'message' => 'Hasil Konsultasi Ditemukan.', 'data' => $rule]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Failed to Konsultasi.', 'error' => $e->getMessage()], 401);
        }
    }

    public function ruleBased($categories = [])
    {
        $rules = Rule::all();
        foreach ($rules as $key => $rule) {
            $ruleBased = $rule->categories->pluck('code')->toArray();

            // Cari data yang ada di kedua array (intersection)
            $matches = array_intersect($categories, $ruleBased);

            // Hitung berapa yang match
            $matchCount = count($matches);

            if ($matchCount > 1) {
                return $rule->with(['rsolusi','rsolusiRekomendasi'])->first();
            }
        }
        return null;
    }
}
