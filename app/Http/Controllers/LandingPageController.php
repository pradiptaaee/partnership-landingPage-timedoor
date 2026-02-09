<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hero;
use App\Models\Banner;
use App\Models\Testimonial;
use App\Models\StudentProject;
use Illuminate\Support\Facades\Session;

class LandingPageController extends Controller
{
    private function getLocaleMapping(): array
    {
        return [
            'en' => ['code' => 'EN', 'flag' => 'images/enFlag.png', 'type' => 'img'],
            'id' => ['code' => 'ID', 'flag' => 'images/idFlag.png', 'type' => 'img'],
            'bn' => ['code' => 'BD', 'flag' => 'bd', 'type' => 'svg'],
            'ar' => ['code' => 'AR', 'flag' => 'images/arFlag.png', 'type' => 'img'],
            'fil' => ['code' => 'PH', 'flag' => 'images/phFlag.png', 'type' => 'img'],
            'ja' => ['code' => 'JP', 'flag' => 'jp', 'type' => 'svg'],
            'ms' => ['code' => 'MY', 'flag' => 'images/myFlag.png', 'type' => 'img'],
        ];
    }

    private function getCurrentLanguageData(): array
    {
        $localeMapping = $this->getLocaleMapping();
        $currentLocale = app()->getLocale();
        return $localeMapping[$currentLocale] ?? $localeMapping['en'];
    }

    private function getHeroImageUrl($hero): string
    {
        $locale = app()->getLocale();
        $colImage = 'image_' . $locale;
        $imagePath = optional($hero)->{$colImage};

        if ($imagePath) {
            return asset('storage/' . $imagePath);
        }

        return 'https://placehold.co/1200x800/e5e7eb/a3a3a3?text=No+Image+For+' . strtoupper($locale);
    }

    private function getFontClasses(): array
    {
        $locale = app()->getLocale();

        $classes = [
            // Hero Section
            'hero_h2' => "text-2xl md:text-5xl lg:text-6xl xl:text-5xl mb-3 xl:mb-8",
            'hero_h1' => "text-3xl md:text-7xl lg:text-8xl xl:text-7xl mb-3 xl:mb-8 leading-none xl:leading-none md:leading-20 lg:leading-24",
            'hero_p' => "text-base sm:text-lg md:text-xl lg:text-2xl xl:text-2xl mb-5 xl:mb-10",
            
            // Proof Section
            'proof_bnr' => "text-xl sm:text-3xl md:text-4xl lg:text-5xl xl:text-4xl",

        ];

        if (in_array($locale, ['id', 'ms', 'fil'])) {
            $classes = [
                // Hero Section
                'hero_h2' => "text-xl md:text-4xl lg:text-5xl xl:text-4xl mb-3 xl:mb-6",
                'hero_h1' => "text-3xl md:text-6xl lg:text-7xl xl:text-6xl mb-3 xl:mb-6 leading-tight",
                'hero_p' => "text-sm sm:text-base md:text-lg lg:text-xl xl:text-xl mb-4 xl:mb-8",

                // Proof Section
                'proof_bnr' => "text-lg sm:text-3xl md:text-4xl lg:text-5xl xl:text-4xl",

                // CTA & Promo Section
                'cta_btn' => "text-sm sm:text-3xl md:text-4xl",
                'cta_btn2' => "text-xs sm:text-3xl md:text-4xl"
            ];
        } 

        return $classes;
    }

    private function processBannersData($banners)
    {
        $locale = app()->getLocale();

        return $banners->map(function ($banner) use ($locale) {
            $banner->localized_title = $banner->title[$locale] ?? $banner->title['en'] ?? '';
            return $banner;
        });
    }

    private function processTestimonialsData($testimonials)
    {
        $locale = app()->getLocale();

        return $testimonials->map(function ($testimonial) use ($locale) {
            $testimonial->localized_review = $testimonial->getTranslation('review', $locale);
            return $testimonial;
        });
    }

    /**
     * Process student projects data with locale-specific project_type
     */
    private function processProjectsData($projects)
    {
        $locale = app()->getLocale();

        return $projects->map(function ($project) use ($locale) {
            $pType = $project->project_type;

            // Handle jika project_type adalah array
            if (is_array($pType)) {
                $project->localized_project_type = $pType[$locale] ?? $pType['en'] ?? $pType['id'] ?? '-';
            }
            // Handle jika project_type adalah JSON string
            elseif (is_string($pType) && (str_contains($pType, '{') || str_contains($pType, '['))) {
                $json = json_decode($pType, true);
                $project->localized_project_type = $json[$locale] ?? $json['en'] ?? $json['id'] ?? $pType;
            }
            // Handle jika project_type adalah string biasa
            else {
                $project->localized_project_type = $pType;
            }

            // Format age display
            $project->formatted_age = $project->age . ' ' . __('Years');

            return $project;
        });
    }

    public function index()
    {
        // Data dari database
        $hero = Hero::first();
        $banners = Banner::latest()->get();
        $testimonials = Testimonial::latest()->get();
        $projects = StudentProject::latest()->take(6)->get();

        // Process data dengan locale
        $banners = $this->processBannersData($banners);
        $testimonials = $this->processTestimonialsData($testimonials);
        $projects = $this->processProjectsData($projects);

        // Data untuk sections
        $currentLangData = $this->getCurrentLanguageData();
        $heroImageUrl = $this->getHeroImageUrl($hero);
        $fontClasses = $this->getFontClasses();

        return view('landing_page.index', compact(
            'hero',
            'banners',
            'testimonials',
            'projects',
            'currentLangData',
            'heroImageUrl',
            'fontClasses'
        ));
    }

    public function changeLanguage($locale)
    {
        $availableLocales = ['en', 'id', 'ms', 'fil', 'ar', 'ja', 'bn'];

        if (in_array($locale, $availableLocales)) {
            Session::put('locale', $locale);
        }

        return redirect()->back();
    }
}
