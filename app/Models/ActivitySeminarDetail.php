<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivitySeminarDetail extends Model
{
    use HasFactory;
    // Menentukan nama tabel (opsional jika nama tabel sudah jamak/plural secara standar)
    protected $table = 'activity_seminar';

    // Mengizinkan semua field diisi (karena validasi sudah dilakukan di Controller)
    protected $guarded = [];

    /**
     * Relasi balik ke PartnerActivity
     */
    public function activity()
    {
        return $this->belongsTo(PartnerActivity::class, 'partner_activity_id');
    }

    /**
     * Accessor untuk foto speaker agar mudah dipanggil di Blade
     */
    public function getSpeakerPhotoUrlAttribute()
    {
        if ($this->speaker_photo) {
            return asset('storage/activity/speakers/' . $this->speaker_photo);
        }
        return asset('images/default-avatar.png'); // Sediakan gambar default jika tidak ada foto
    }
}
