<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class StudentProject extends Model
{
    use HasFactory;

    /**
     * Atribut yang dapat diisi melalui mass assignment.
     *
     * @var array
     */
    protected $fillable = [
        'student_name', 
        'age', 
        'project_type', 
        'project_image'
    ];

    /**
     * Casting atribut ke tipe data tertentu.
     * Project type disimpan sebagai array untuk mendukung lokalisasi (JSON).
     *
     * @var array
     */
    protected $casts = [
        'project_type' => 'array',
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
        // Filter berdasarkan kata kunci pencarian
        $query->when($filters['search'] ?? false, function ($query, $search) {
            $query->where(function($q) use ($search) {
                $q->where('student_name', 'like', '%' . $search . '%')
                  ->orWhere('project_type', 'like', '%' . $search . '%');
            });
        });

        // Logika pengurutan data
        $query->when($filters['sort'] ?? false, function ($query, $sort) {
            match ($sort) {
                'oldest' => $query->reorder('created_at', 'asc'),
                'az'     => $query->reorder('student_name', 'asc'),
                'za'     => $query->reorder('student_name', 'desc'),
                default  => $query->latest(),
            };
        });
    }
}