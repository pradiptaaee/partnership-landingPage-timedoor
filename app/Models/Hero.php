<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hero extends Model
{
    use HasFactory;

    protected $table = 'hero';

    protected $guarded = [];

    /**
     * Map localized language data for banner management.
     */
    public function getLanguageDataAttribute()
    {
        return collect(config('landing.languages'))->map(function ($lang) {
            return (object) [
                'code'       => $lang['code'],
                'name'       => $lang['name'],
                'flag'       => $lang['flag'],
                'col'        => 'image_' . $lang['code'],
                'input_id'   => 'input_' . $lang['code'],
                'preview_id' => 'preview_' . $lang['code'],
                'value'      => $this->{'image_' . $lang['code']},
            ];
        });
    }
}