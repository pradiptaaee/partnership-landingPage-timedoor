<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('component.navbar', function ($view) {

            $localeMapping = [
                'en' => ['code' => 'EN', 'flag' => 'images/enFlag.png', 'type' => 'img'],
                'id' => ['code' => 'ID', 'flag' => 'images/idFlag.png', 'type' => 'img'],
                'bn' => ['code' => 'BD', 'flag' => 'bd', 'type' => 'svg'],
                'ar' => ['code' => 'AR', 'flag' => 'images/arFlag.png', 'type' => 'img'],
                'fil' => ['code' => 'PH', 'flag' => 'images/phFlag.png', 'type' => 'img'],
                'ja' => ['code' => 'JP', 'flag' => 'jp', 'type' => 'svg'],
                'ms' => ['code' => 'MY', 'flag' => 'images/myFlag.png', 'type' => 'img'],
            ];

            $locale = app()->getLocale();

            $view->with('currentLangData', $localeMapping[$locale] ?? $localeMapping['en']);
        });
        Paginator::useTailwind();

        if (str_contains(config('app.url'), 'ngrok-free.app') || config('app.env') !== 'local') {
        URL::forceScheme('https');
    }
    }
}
