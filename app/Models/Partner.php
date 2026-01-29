<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


class Partner extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug', 'category', 'description', 'logo', 'email', 'no_telepon'];

    public function activities()
    {
        return $this->hasMany(PartnerActivity::class);
    }

    public function getLogoUrlAttribute()
    {
        if ($this->logo) {
            return Storage::disk('public');
        }
        return null;
    }

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($partner) {
            if ($partner->logo && Storage::disk('public')->exists($partner->logo)) {
                Storage::disk('public')->delete($partner->logo);
            }
        });
    }
}
