<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomeScreenSection extends Model
{
    use HasFactory;

    protected $fillable = [
        'section_type',
        'is_active',
        'sequence',
        'content',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'content' => 'array',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
