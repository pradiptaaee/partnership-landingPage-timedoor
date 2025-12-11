<?php

namespace App\Http\Controllers;

use App\Models\Partner;
use Illuminate\Http\Request;

class PartnerController extends Controller
{
    public function index()
    {
        // Di Controller
        $partners = Partner::paginate(6); // 6 cards per page
        return view('partners.index', compact('partners'));
    }

    public function show(Partner $partner)
    {
        // $partner = Partner::where('slug', $slug)->firstOrFail();

        return view('partners.show', compact('partners'));
    }
}
