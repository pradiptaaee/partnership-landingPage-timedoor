<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hero extends Model
{
    use HasFactory;

    // PENTING: Menentukan nama tabel yang benar sesuai migrasi Anda
    protected $table = 'hero';

    // PENTING: Matikan fitur keamanan sementara agar semua data bisa masuk
    // (Ini cara paling ampuh untuk memastikan data masuk)
    protected $guarded = []; 
    
    // Atau jika ingin tetap pakai fillable, pastikan persis seperti ini:
    /*
    protected $fillable = [
        'hero_title', 'hero_subtitle', 'hero_desc',
        'image_id', 
        'image_en', 
        'image_ja', // <--- Pastikan ada
        'image_ar', // <--- Pastikan ada
        'image_bn', // <--- Pastikan ada
        'image_fil',// <--- Pastikan ada
        'image_ms', // <--- Pastikan ada
    ];
    */
}