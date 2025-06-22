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
        // Get all rules with their categories and solusi/solusiRekomendasi relations
        $rules = Rule::with([
            'categories',
        ])
            ->whereHas('categories', function ($query) use ($categories) {
                $query->whereIn('code', $categories);
            }, '>', 1)
            ->get();

        foreach ($rules as $rule) {
            // Calculate total price for solusi using DB raw if rsolusi exists
            if ($rule->rsolusi) {
                $ids = [
                    $rule->rsolusi->motherboard,
                    $rule->rsolusi->processor,
                    $rule->rsolusi->ram,
                    $rule->rsolusi->casing,
                    $rule->rsolusi->storage_primary,
                    $rule->rsolusi->storage_secondary,
                    $rule->rsolusi->vga,
                    $rule->rsolusi->psu,
                    $rule->rsolusi->monitor,
                ];
                $ids = array_filter($ids); // Remove nulls
                $rule->total_price_solusi = 0;
                if (!empty($ids)) {
                    $rule->total_price_solusi = \DB::table('components')
                        ->whereIn('id', $ids)
                        ->sum('price');
                }
            }

            // Calculate total price for solusi rekomendasi using DB raw if rsolusiRekomendasi exists
            if ($rule->rsolusiRekomendasi) {
                $ids = [
                    $rule->rsolusiRekomendasi->motherboard,
                    $rule->rsolusiRekomendasi->processor,
                    $rule->rsolusiRekomendasi->ram,
                    $rule->rsolusiRekomendasi->casing,
                    $rule->rsolusiRekomendasi->storage_primary,
                    $rule->rsolusiRekomendasi->storage_secondary,
                    $rule->rsolusiRekomendasi->vga,
                    $rule->rsolusiRekomendasi->psu,
                    $rule->rsolusiRekomendasi->monitor,
                ];
                $ids = array_filter($ids); // Remove nulls
                $rule->total_price_solusi_rekomendasi = 0;
                if (!empty($ids)) {
                    $rule->total_price_solusi_rekomendasi = \DB::table('components')
                        ->whereIn('id', $ids)
                        ->sum('price');
                }
            }

            return $rule;
        }

        return null;
    }
}
