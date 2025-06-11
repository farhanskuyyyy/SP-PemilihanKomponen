<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Clasification extends Model
{
    protected $fillable = [
        'name',
        'pertanyaan',
    ];

    public function categories()
    {
        return $this->hasMany(Category::class);
    }
}
