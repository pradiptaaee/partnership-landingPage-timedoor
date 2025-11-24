<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class PartnerActivity extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     */
    protected $table = 'partner_activities';

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'partner_id',
        'title',
        'slug',
        'short_description',
        'full_description',
        'activity_date',
        'featured_image',
    ];

    /**
     * The attributes that should be cast.
     */
    protected $casts = [
        'activity_date' => 'date',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the partner that owns the activity.
     */
    public function partner()
    {
        return $this->belongsTo(Partner::class);
    }

    /**
     * Get the photos for the activity.
     */
    public function photos()
    {
        return $this->hasMany(PhotoActivity::class, 'activity_id');
    }

    /**
     * Get the featured image URL.
     */
    public function getFeaturedImageUrlAttribute()
    {
        if ($this->featured_image) {
            return Storage::disk('public');
        }
        return null;
    }

    /**
     * Boot the model.
     */
    protected static function boot()
    {
        parent::boot();

        // Delete featured image and photos when activity is deleted
        static::deleting(function ($activity) {
            // Delete featured image
            if ($activity->featured_image && Storage::disk('public')->exists($activity->featured_image)) {
                Storage::disk('public')->delete($activity->featured_image);
            }

            // Delete all photos
            foreach ($activity->photos as $photo) {
                if (Storage::disk('public')->exists($photo->image_path)) {
                    Storage::disk('public')->delete($photo->image_path);
                }
                $photo->delete();
            }
        });
    }
}