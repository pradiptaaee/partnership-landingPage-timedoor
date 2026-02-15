<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Storage;

class PartnerActivity extends Model
{
    use HasFactory;

    protected $fillable = [
        'partner_id',
        'title',
        'slug',
        'category_activity',
        'full_description',
        'activity_date',
        'featured_image',
    ];

    // File: app/Models/PartnerActivity.php
    public function seminarDetail()
    {
        return $this->hasOne(ActivitySeminarDetail::class, 'partner_activity_id');
    }

    public function workshopDetail()
    {
        return $this->hasOne(ActivityWorkshopDetail::class, 'partner_activity_id');
    }

    /**
     * =========================
     * CASTS
     * =========================
     */
    protected $casts = [
        'activity_date' => 'date',
    ];

    public function partner()
    {
        return $this->belongsTo(Partner::class);
    }

    public function photos()
    {
        return $this->hasMany(PhotoActivity::class, 'partner_activity_id');
    }

    
    public function getFeaturedImageUrlAttribute(): ?string
    {
        return $this->featured_image
            ? asset('storage/activity/featured/' . $this->featured_image)
            : null;
    }

    /**
     * =========================
     * HELPER
     * =========================
     */
    public function hasSeminarExtra(): bool
    {
        return strtolower($this->category_activity) === 'seminar';
    }

    /**
     * =========================
     * MODEL EVENTS
     * =========================
     */
    protected static function booted()
    {
        static::deleting(function ($activity) {

            // featured image
            if ($activity->featured_image) {
                Storage::disk('public')->delete($activity->featured_image);
            }

            // speaker photo (extra)
            // if (!empty($activity->extra_attributes['speaker_photo'])) {
            //     Storage::disk('public')->delete(
            //         $activity->extra_attributes['speaker_photo']
            //     );
            // }

            // gallery photos
            foreach ($activity->photos as $photo) {
                $photo->delete();
            }
        });
    }
}
