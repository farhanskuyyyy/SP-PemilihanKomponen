<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'code',
        'name',
        'value',
        'clasification_id',
    ];

    public function clasification()
    {
        return $this->belongsTo(Clasification::class);
    }
}
