<?php

namespace App\Http\Controllers;

use App\Models\Partner;
use App\Models\PartnerActivity;
use Illuminate\Http\Request;

class PartnerController extends Controller
{
    public function index()
    {
        $partners = Partner::latest()->get();
        $activities = PartnerActivity::latest()->paginate(2);

        return view('partners.index', compact('partners', 'activities'));
    }

    public function show(Partner $partner, $slug)
    {
        $activity = PartnerActivity::where('slug', $slug)->firstOrFail();


        return view('partners.show', compact('partners', 'activity'));
    }
}
