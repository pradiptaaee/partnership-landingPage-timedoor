<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class PhotoActivity extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     */
    protected $table = 'photos_activities';

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'activity_id',
        'image_path',
    ];

    /**
     * The attributes that should be cast.
     */
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the activity that owns the photo.
     */
    public function activity()
    {
        return $this->belongsTo(PartnerActivity::class, 'activity_id');
    }

    /**
     * Get the image URL.
     */
    public function getImageUrlAttribute()
    {
        if ($this->image_path) {
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

        // Delete image file when photo record is deleted
        static::deleting(function ($photo) {
            if ($photo->image_path && Storage::disk('public')->exists($photo->image_path)) {
                Storage::disk('public')->delete($photo->image_path);
            }
        });
    }
}