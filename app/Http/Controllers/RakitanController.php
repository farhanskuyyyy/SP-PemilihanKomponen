<?php

namespace App\Http\Controllers;

use App\Models\Component;
use Illuminate\Http\Request;
use App\Models\Rakitan;

class RakitanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $components = Component::all();
        return view('rakitan.index', compact('components'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'code'              => 'required|unique:rakitan,code|max:100',
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

        $validated['created_by'] = auth()->user()->id;

        $rakitan = Rakitan::create($validated);

        return response()->json(['success' => true, 'message' => 'Rakitan created successfully.', 'data' => $rakitan]);
    }

    /**
     * Show the form for editing the specified resource.
     * Return JSON for modal.
     */
    public function edit(string $id)
    {
        $rakitan = Rakitan::findOrFail($id);
        return response()->json(['success' => true, 'data' => $rakitan]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $rakitan = Rakitan::findOrFail($id);

        $validated = $request->validate([
            'code'              => 'required|max:100|unique:rakitan,code,' . $id,
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

        $validated['created_by'] = auth()->user()->id;

        $rakitan->update($validated);

        return response()->json(['success' => true, 'message' => 'Rakitan updated successfully.', 'data' => $rakitan]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $rakitan = Rakitan::findOrFail($id);
        $rakitan->delete();

        return response()->json(['success' => true, 'message' => 'Rakitan deleted successfully.']);
    }

    /**
     * Get data for DataTables via AJAX.
     */
    public function getDataList(Request $request)
    {
        $rakitans = Rakitan::with([
            'motherboardRelation',
            'processorRelation',
            'ramRelation',
            'casingRelation',
            'storagePrimaryRelation',
            'storageSecondaryRelation',
            'vgaRelation',
            'psuRelation',
            'monitorRelation',
            'creator',
        ])->whereHas('creator', function ($q) {
            $q->where('role', 'admin');
        })->get()->map(function ($rakitan) {
            $totalPrice = $rakitan->motherboardRelation->price +
                $rakitan->processorRelation->price +
                $rakitan->ramRelation->price +
                $rakitan->casingRelation->price +
                $rakitan->storagePrimaryRelation->price +
                ($rakitan->storageSecondaryRelation ? $rakitan->storageSecondaryRelation->price : 0) +
                ($rakitan->vgaRelation ? $rakitan->vgaRelation->price : 0) +
                $rakitan->psuRelation->price +
                $rakitan->monitorRelation->price;

            return [
                'id' => $rakitan->id,
                'code' => $rakitan->code,
                'name' => $rakitan->name,
                'motherboard' => $rakitan->motherboardRelation->name ?? '-',
                'processor' => $rakitan->processorRelation->name ?? '-',
                'ram' => $rakitan->ramRelation->name ?? '-',
                'casing' => $rakitan->casingRelation->name ?? '-',
                'storage_primary' => $rakitan->storagePrimaryRelation->name ?? '-',
                'storage_secondary' => $rakitan->storageSecondaryRelation->name ?? '-',
                'vga' => $rakitan->vgaRelation->name ?? '-',
                'psu' => $rakitan->psuRelation->name ?? '-',
                'monitor' => $rakitan->monitorRelation->name ?? '-',
                'motherboard_relation' => $rakitan->motherboardRelation,
                'processor_relation' => $rakitan->processorRelation,
                'ram_relation' => $rakitan->ramRelation,
                'casing_relation' => $rakitan->casingRelation,
                'storage_primary_relation' => $rakitan->storagePrimaryRelation,
                'storage_secondary_relation' => $rakitan->storageSecondaryRelation,
                'vga_relation' => $rakitan->vgaRelation,
                'psu_relation' => $rakitan->psuRelation,
                'monitor_relation' => $rakitan->monitorRelation,
                'created_by' => $rakitan->creator ? $rakitan->creator->name : '-',
                'total_price' => $totalPrice,
                'created_at' => $rakitan->created_at,
                'updated_at' => $rakitan->updated_at,
            ];
        });
        return response()->json(['data' => $rakitans]);
    }


    public function print(string $code)
    {
        $rakitan = Rakitan::with([
            'motherboardRelation',
            'processorRelation',
            'ramRelation',
            'casingRelation',
            'storagePrimaryRelation',
            'storageSecondaryRelation',
            'vgaRelation',
            'psuRelation',
            'monitorRelation'
        ])->where('code', $code)->firstOrFail();
        return view('rakitan.print', compact('rakitan'));
    }
}
