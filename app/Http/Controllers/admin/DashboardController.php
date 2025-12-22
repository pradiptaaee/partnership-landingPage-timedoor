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
    public function index()
    {
        // 1. STATISTIK UTAMA (Card Atas)
        // Kita pakai fungsi count() untuk menghitung jumlah data di database
        $totalProjects = StudentProject::count();
        $totalTestimonials = Testimonial::count();
        $totalBanners = Banner::count();
        
        // Jika belum ada model Partner, kita kasih nilai 0 dulu biar ga error
        // $totalPartners = Partner::count(); 
        $totalPartners = 0; 

        // 2. DATA UNTUK CHART DONAT (Sebaran Tipe Project)
        // Ini akan mengelompokkan project berdasarkan 'project_type' dan menghitung jumlahnya
        $projectTypes = StudentProject::select('project_type', DB::raw('count(*) as total'))
                        ->groupBy('project_type')
                        ->pluck('total', 'project_type');

        // 3. TABEL PROJECT TERBARU (5 Data Terakhir)
        $recentProjects = StudentProject::latest()->take(5)->get();

        // 4. Kirim semua variabel ke View
        return view('admin.dashboard', compact(
            'totalPartners', 
            'totalProjects', 
            'totalTestimonials',
            'totalBanners',
            'projectTypes',
            'recentProjects'
        ));
    }
}