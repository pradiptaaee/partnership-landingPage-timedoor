<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

// Import Model yang sudah kita buat sebelumnya
use App\Models\StudentProject;
use App\Models\Testimonial;
use App\Models\Banner;
// use App\Models\Partner; // Uncomment jika Anda sudah punya Model Partner

class DashboardController extends Controller
{
    // Di DashboardController.php
    public function index()
    {
        // Stats Utama
        $totalPartners = \App\Models\Partner::count();
        $totalProjects = \App\Models\StudentProject::count(); // Sesuaikan nama model
        $totalTestimonials = \App\Models\Testimonial::count(); // Sesuaikan nama model
        
        // Kegiatan bulan ini (Penting untuk monitoring)
        $activitiesThisMonth = \App\Models\PartnerActivity::whereMonth('activity_date', now()->month)
                                ->whereYear('activity_date', now()->year)
                                ->count();

        // 5 Kegiatan yang AKAN DATANG (Upcoming)
        $upcomingActivities = \App\Models\PartnerActivity::with('partner')
                                ->where('activity_date', '>=', now())
                                ->orderBy('activity_date', 'asc')
                                ->take(5)
                                ->get();

        // Project Terbaru (untuk log)
        $latestProjects = \App\Models\StudentProject::latest()->take(3)->get();

        return view('admin.dashboard', compact(
            'totalPartners', 
            'totalProjects', 
            'totalTestimonials', 
            'activitiesThisMonth',
            'upcomingActivities',
            'latestProjects'
        ));
    }
}