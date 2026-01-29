<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivityWorkshopDetail extends Model
{
    use HasFactory;
    protected $table = 'activity_workshop';

    protected $guarded = [];

    /**
     * Relasi balik ke PartnerActivity
     */
    public function activity()
    {
        return $this->belongsTo(PartnerActivity::class, 'partner_activity_id');
    }
}
