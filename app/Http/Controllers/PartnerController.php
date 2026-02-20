<?php

namespace App\Http\Controllers;

use App\Http\Controllers\landing\BasePageController;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Banner;
use App\Models\Partner;
use App\Models\PartnerActivity;
use App\Models\PhotoActivity;


class PartnerController extends BasePageController
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
    public function index(Request $request)
    {
        $partners = Partner::whereNotNull('logo')->where('logo', '!=', '')->get();
        $currentLangData = $this->getCurrentLanguageData();

        $activities = PartnerActivity::with('partner')
            ->when($request->search, function ($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%');
            })
            ->when($request->year, function ($q) use ($request) {
                $q->whereYear('activity_date', $request->year);
            })
            ->latest()
            ->paginate(3);

        return view('partners.index', compact('partners','currentLangData', 'activities'));
    }


    public function show($slug)
    {
        $activity = PartnerActivity::with('partner', 'photos',
            'seminarDetail',
            'workshopDetail',
        )
            ->where('slug', $slug)
            ->firstOrFail();
        $currentLangData = $this->getCurrentLanguageData();

        return view('partners.show', compact('activity', 'currentLangData' ));
    }

    public function store(Request $request)
    {
        // 1. BUAT PARTNER ACTIVITY DULU
        $activity = PartnerActivity::create([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'activity_date' => $request->activity_date,
            'short_description' => $request->short_description,
            'full_description' => $request->full_description,
            'category' => $request->category,
        ]);

        // 2. UPLOAD PHOTOS
        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $photo) {
                $path = $photo->store('activities/gallery', 'public');

                PhotoActivity::create([
                    'partner_activity_id' => $activity->id,  // Sesuaikan dengan nama kolom foreign key
                    'path' => $path
                ]);
            }
        }

        return redirect()->route('partners.index')->with('success', 'Berhasil!');
    }
}
