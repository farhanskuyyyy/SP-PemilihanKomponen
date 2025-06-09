<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Component extends Model
{
    protected $fillable = [
        'name',
        'code',
        'description',
        'component_type_id',
        'price',
        'is_active',
    ];

    public function type()
    {
        return $this->belongsTo(ComponentType::class, 'component_type_id');
    }
}
