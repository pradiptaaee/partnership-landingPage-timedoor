<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Testimonial extends Model
{
    use HasFactory;

    /**
     * Atribut yang dapat diisi melalui mass assignment.
     *
     * @var array
     */
    protected $fillable = [
        'parent_name', 
        'student_name', 
        'course_name', 
        'review', 
        'parent_image'
    ];

    /**
     * Casting atribut ke tipe data tertentu.
     * Kolom review disimpan sebagai array untuk mendukung data multi-bahasa (JSON).
     *
     * @var array
     */
    protected $casts = [
        'review' => 'array',
    ];

    /**
     * Local Scope untuk mempermudah pemfilteran data berdasarkan pencarian dan pengurutan.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param array $filters
     * @return void
     */
    public function scopeFilter(Builder $query, array $filters): void
    {
        // Filter berdasarkan pencarian nama orang tua atau siswa
        $query->when($filters['search'] ?? false, function ($query, $search) {
            $query->where(function($q) use ($search) {
                $q->where('parent_name', 'like', '%' . $search . '%')
                  ->orWhere('student_name', 'like', '%' . $search . '%');
            });
        });

        // Logika pengurutan data
        $query->when($filters['sort'] ?? false, function ($query, $sort) {
            match ($sort) {
                'oldest' => $query->reorder('created_at', 'asc'),
                'az'     => $query->reorder('parent_name', 'asc'),
                'za'     => $query->reorder('parent_name', 'desc'),
                default  => $query->latest(),
            };
        });
    }
}