<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class PartnerActivity extends Model
{
    use HasFactory;

    protected $fillable = [
        'partner_id',
        'title',
        'slug',
        'category_activity',
        'short_description',
        'full_description',
        'activity_date',
        'featured_image'
    ];

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

    protected $casts = [
        'activity_date' => 'date',
    ];

    public function hasExtraDescription()
    {
        $allowed = ['seminar', 'workshop'];
        return in_array(strtolower($this->category_activity), $allowed);
    }

}
