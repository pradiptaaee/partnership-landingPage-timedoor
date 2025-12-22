<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder; // Import Builder

class Banner extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    /**
     * Scope untuk memfilter pencarian dan sorting.
     * Cara panggil: Banner::filter(request(['search', 'sort']))->get();
     */
    public function scopeFilter(Builder $query, array $filters): void
    {
        // 1. Logika Search (Menggunakan when agar lebih rapi)
        $query->when($filters['search'] ?? false, function ($query, $search) {
            $query->where('title', 'like', '%' . $search . '%');
        });

        // 2. Logika Sort
        $query->when($filters['sort'] ?? false, function ($query, $sort) {
            match ($sort) {
                'oldest' => $query->reorder('created_at', 'asc'),
                'az'     => $query->reorder('title', 'asc'),
                'za'     => $query->reorder('title', 'desc'),
                default  => $query->latest(), // Default tetap terbaru
            };
        });
    }
}