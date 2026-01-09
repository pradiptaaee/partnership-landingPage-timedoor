<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Banner;
use App\Models\Partner;
use App\Models\PartnerActivity;
use App\Models\PhotoActivity;


class PartnerController extends Controller
{
    public function index(Request $request)
    {
        $partners = Partner::latest()->get();

        $activities = PartnerActivity::with('partner')
            ->when($request->search, function ($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%');
            })
            ->when($request->year, function ($q) use ($request) {
                $q->whereYear('activity_date', $request->year);
            })
            ->latest()
            ->paginate(6);

        return view('partners.index', compact('partners', 'activities'));
    }


    public function show($slug)
    {
        $activity = PartnerActivity::with('partner', 'photos')
            ->where('slug', $slug)
            ->firstOrFail();

        return view('partners.show', compact('activity'));
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
