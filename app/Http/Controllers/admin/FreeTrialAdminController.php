<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FreeTrial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class FreeTrialAdminController extends Controller
{
    public function index()
    {
        $trials = FreeTrial::latest()->get();
        return view('admin.landing_page.free_trials.index', compact('trials'));
    }

}