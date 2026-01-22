<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Spatie\Translatable\HasTranslations;

class Testimonial extends Model
{
    use HasFactory;
    use HasTranslations;
    // Sesuaikan dengan model Anda
    protected $fillable = [
        'parent_name', 
        'student_name', 
        'course_name', 
        'review', 
        'parent_image'
    ];

    public $translatable = ['review'];

    /**
     * Scope untuk memfilter pencarian dan sorting (Laravel Best Practice).
     */
    public function scopeFilter(Builder $query, array $filters): void
    {
        // 1. Logika Search (Mencari di Nama Ortu ATAU Nama Murid)
        $query->when($filters['search'] ?? false, function ($query, $search) {
            $query->where(function($q) use ($search) {
                $q->where('parent_name', 'like', '%' . $search . '%')
                  ->orWhere('student_name', 'like', '%' . $search . '%');
            });
        });

        // 2. Logika Sort (Menggunakan match expression PHP 8+)
        $query->when($filters['sort'] ?? false, function ($query, $sort) {
            match ($sort) {
                'oldest' => $query->reorder('created_at', 'asc'),   // Terlama
                'az'     => $query->reorder('parent_name', 'asc'),  // Abjad A-Z
                'za'     => $query->reorder('parent_name', 'desc'), // Abjad Z-A
                default  => $query->latest(),                       // Default Terbaru
            };
        });
    }
}