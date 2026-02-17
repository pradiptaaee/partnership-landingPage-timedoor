<?php

namespace App\Http\Controllers\landing;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BasePageController extends Controller
{
    protected function getLocaleMapping(): array
    {
        return [
            'en'  => ['code' => 'EN', 'flag' => 'images/enFlag.png', 'type' => 'img'],
            'id'  => ['code' => 'ID', 'flag' => 'images/idFlag.png', 'type' => 'img'],
            'bn'  => ['code' => 'BD', 'flag' => 'bd',                'type' => 'svg'],
            'ar'  => ['code' => 'AR', 'flag' => 'images/arFlag.png', 'type' => 'img'],
            'fil' => ['code' => 'PH', 'flag' => 'images/phFlag.png', 'type' => 'img'],
            'ja'  => ['code' => 'JP', 'flag' => 'jp',                'type' => 'svg'],
            'ms'  => ['code' => 'MY', 'flag' => 'images/myFlag.png', 'type' => 'img'],
        ];
    }

    protected function getCurrentLanguageData(): array
    {
        $localeMapping = $this->getLocaleMapping();
        $currentLocale = app()->getLocale();
        return $localeMapping[$currentLocale] ?? $localeMapping['en'];
    }
}
