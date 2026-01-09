<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder; // <--- WAJIB IMPORT INI

class StudentProject extends Model
{
    use HasFactory;

    // Sesuai punya Anda
    protected $fillable = ['student_name', 'project_type', 'project_image'];

    /**
     * Scope Filter untuk Search & Sort
     */
    public function scopeFilter(Builder $query, array $filters): void
    {
        // 1. Search (Cari berdasarkan Nama Murid atau Project Type)
        $query->when($filters['search'] ?? false, function ($query, $search) {
            $query->where(function($q) use ($search) {
                $q->where('student_name', 'like', '%' . $search . '%')
                  ->orWhere('project_type', 'like', '%' . $search . '%');
            });
        });

        // 2. Sort
        $query->when($filters['sort'] ?? false, function ($query, $sort) {
            match ($sort) {
                'oldest' => $query->reorder('created_at', 'asc'),
                'az'     => $query->reorder('student_name', 'asc'), // Urut abjad nama murid
                'za'     => $query->reorder('student_name', 'desc'),
                default  => $query->latest(),
            };
        });
    }
}