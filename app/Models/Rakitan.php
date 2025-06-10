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

    public function motherboard()
    {
        return $this->belongsTo(Component::class, 'motherboard');
    }

    public function processor()
    {
        return $this->belongsTo(Component::class, 'processor');
    }

    public function ram()
    {
        return $this->belongsTo(Component::class, 'ram');
    }

    public function casing()
    {
        return $this->belongsTo(Component::class, 'casing');
    }

    public function storagePrimary()
    {
        return $this->belongsTo(Component::class, 'storage_primary');
    }

    public function storageSecondary()
    {
        return $this->belongsTo(Component::class, 'storage_secondary');
    }

    public function vga()
    {
        return $this->belongsTo(Component::class, 'vga');
    }

    public function psu()
    {
        return $this->belongsTo(Component::class, 'psu');
    }

    public function monitor()
    {
        return $this->belongsTo(Component::class, 'monitor');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }
}
