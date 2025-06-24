<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rakitan extends Model
{
    protected $table = 'rakitan';

    protected $fillable = [
        'code',
        'name',
        'motherboard',
        'processor',
        'ram',
        'casing',
        'storage_primary',
        'storage_secondary',
        'vga',
        'psu',
        'monitor',
        'created_by',
    ];

    public function motherboardRelation()
    {
        return $this->belongsTo(Component::class, 'motherboard');
    }

    public function processorRelation()
    {
        return $this->belongsTo(Component::class, 'processor');
    }

    public function ramRelation()
    {
        return $this->belongsTo(Component::class, 'ram');
    }

    public function casingRelation()
    {
        return $this->belongsTo(Component::class, 'casing');
    }

    public function storagePrimaryRelation()
    {
        return $this->belongsTo(Component::class, 'storage_primary');
    }

    public function storageSecondaryRelation()
    {
        return $this->belongsTo(Component::class, 'storage_secondary');
    }

    public function vgaRelation()
    {
        return $this->belongsTo(Component::class, 'vga');
    }

    public function psuRelation()
    {
        return $this->belongsTo(Component::class, 'psu');
    }

    public function monitorRelation()
    {
        return $this->belongsTo(Component::class, 'monitor');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }
}
