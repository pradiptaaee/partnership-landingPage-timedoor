<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage; // Tambahkan ini

class Banner extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'image',
        'is_active'
    ];

    // PENTING: Casting ini wajib agar bisa simpan JSON (en, id, ja, dll)
    protected $casts = [
        'title' => 'array',
        'description' => 'array',
        'is_active' => 'boolean',
    ];

    // Helper untuk ambil terjemahan (Opsional, tapi berguna di Blade)
    public function getTranslation($field, $locale)
    {
        $data = $this->$field;
        // Coba ambil sesuai bahasa user, kalau tidak ada, ambil bahasa inggris
        return $data[$locale] ?? $data['en'] ?? '';
    }
}