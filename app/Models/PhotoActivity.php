<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class PhotoActivity extends Model
{
    protected $table = 'photos_activities';

    protected $fillable = [
        'activity_id',
        'image_path'
    ];

    public function activity()
    {
        return $this->belongsTo(PartnerActivity::class, 'activity_id');
    }

    public function getImageUrlAttribute()
    {
        return $this->image_path
            ? asset('storage/' . $this->image_path)
            : null;
    }

    protected static function booted()
    {
        static::deleting(function ($photo) {
            if ($photo->image_path) {
                Storage::disk('public')->delete($photo->image_path);
            }
        });
    }
}
