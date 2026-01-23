<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class PartnerActivity extends Model
{
    use HasTranslations;

    protected $fillable = [
        'partner_id',
        'title',
        'category_activity',
        'short_description',
        'full_description',
        'activity_date',
        'extra_attributes',
        'featured_image',
    ];

    protected $casts = [
        'extra_attributes' => 'array',
        'activity_date' => 'date',
    ];

    public function getSpeakerNameAttribute()
    {
        return $this->extra_attributes['speaker_name'] ?? null;
    }

    public function getMentorNameAttribute()
    {
        return $this->extra_attributes['mentor_name'] ?? null;
    }

    /**
     * Mengambil Foto Speaker dari JSON extra_attributes (Jika ada)
     */
    public function getSpeakerPhotoUrlAttribute()
    {
        $photo = $this->extra_attributes['speaker_photo'] ?? null;
        return $photo ? asset('storage/activity/speakers/' . $photo) : null;
    }

    // Optional helper
    public function getExtra(string $key, $default = null)
    {
        return $this->extra_attributes[$key] ?? $default;
    }

    public function partner()
    {
        return $this->belongsTo(Partner::class);
    }

    public function photos()
    {
        return $this->hasMany(PhotoActivity::class, 'activity_id');
    }

    // URL accessor
    public function getFeaturedImageUrlAttribute()
    {
        return $this->featured_image
            ? asset('storage/activity/featured/' . $this->featured_image)
            : null;
    }
    // public function getFeaturedImageUrlAttribute()
    // {
    //     return $this->featured_image
    //         ? asset('storage/' . $this->featured_image)
    //         : null;
    // }

    // Delete images automatically when activity is deleted
    protected static function booted()
    {
        static::deleting(function ($activity) {
            if ($activity->featured_image) {
                Storage::disk('public')->delete($activity->featured_image);
            }

            foreach ($activity->photos as $photo) {
                $photo->delete(); // model PhotoActivity will delete its file
            }
        });
    }


    public function hasExtraDescription()
    {
        $allowed = ['seminar', 'workshop'];
        return in_array(strtolower($this->category_activity), $allowed);
    }

}
