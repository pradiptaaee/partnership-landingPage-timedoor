<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Banner extends Model
{
    use HasFactory;

    /**
     * Atribut yang dapat diisi melalui mass assignment.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'description',
        'image',
        'is_active'
    ];

    /**
     * Casting atribut ke tipe data tertentu.
     * Title dan Description disimpan sebagai array untuk mendukung multi-bahasa (JSON).
     *
     * @var array
     */
    protected $casts = [
        'title' => 'array',
        'description' => 'array',
        'is_active' => 'boolean',
    ];

    /**
     * Mendapatkan terjemahan atribut berdasarkan locale yang diberikan.
     * Menggunakan bahasa Inggris (en) sebagai fallback jika locale tidak ditemukan.
     *
     * @param string $field
     * @param string $locale
     * @return string
     */
    public function getTranslation($field, $locale)
    {
        $data = $this->$field;
        return $data[$locale] ?? $data['en'] ?? '';
    }
}