<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Partner extends Model
{
    use HasFactory;

    // protected $table = 'partners';
    protected $fillable = ['name', 'slug', 'category', 'description', 'logo'];

    public function activities()
    {
        return $this->hasMany(PartnerActivity::class);
    }

    /**
     * Get the logo URL.
     */
    public function getLogoUrlAttribute()
    {
        if ($this->logo) {
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

        // Delete logo when partner is deleted
        static::deleting(function ($partner) {
            if ($partner->logo && Storage::disk('public')->exists($partner->logo)) {
                Storage::disk('public')->delete($partner->logo);
            }
        });
    }
}
