<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rule extends Model
{
    protected $fillable = [
        'description',
        'solusi',
        'solusi_rekomendasi',
        'description_rekomendasi',
    ];

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'rule_categories', 'rule_id', 'category_id');
    }

    public function rsolusi()
    {
        return $this->belongsTo(Rakitan::class, 'solusi');
    }

    public function rsolusiRekomendasi()
    {
        return $this->belongsTo(Rakitan::class, 'solusi_rekomendasi');
    }
}
