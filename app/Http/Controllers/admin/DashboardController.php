<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Partner;
use App\Models\StudentProject;
use App\Models\Testimonial;
use App\Models\PartnerActivity;
use App\Models\FreeTrial;

class DashboardController extends Controller
{
    /**
     * Menampilkan halaman ringkasan statistik dashboard admin.
     */
    public function index()
    {
        // Hitung total statistik utama
        $totalPartners = Partner::count();
        $totalProjects = StudentProject::count();
        $totalTestimonials = Testimonial::count();
        $totalFreeTrials = FreeTrial::count();
        
        // Ambil jumlah kegiatan yang terdaftar pada bulan berjalan
        $activitiesThisMonth = PartnerActivity::whereMonth('activity_date', now()->month)
                                ->whereYear('activity_date', now()->year)
                                ->count();
        // Kegiatan bulan ini (Penting untuk monitoring)
        $totalActivities = \App\Models\PartnerActivity::count();

        // Ambil 5 agenda kegiatan mendatang termasuk hari ini
        $upcomingActivities = PartnerActivity::with('partner')
                                ->where('activity_date', '>=', now()->startOfDay())
                                ->orderBy('activity_date', 'asc')
                                ->take(5)
                                ->get();

        // Ambil 5 proyek siswa yang paling baru ditambahkan
        $latestProjects = StudentProject::latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'totalPartners', 
            'totalProjects', 
            'totalTestimonials', 
            'activitiesThisMonth',
            'totalFreeTrials',
            'totalActivities',
            'upcomingActivities',
            'latestProjects'
        ));
    }
}