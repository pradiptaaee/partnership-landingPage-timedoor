<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Hero; // PENTING: Biar index gak error
use App\Models\Banner;
use App\Models\Testimonial;
use App\Models\StudentProject;
use App\Models\FreeTrial;

class LandingController extends Controller
{
    // 1. Fungsi Utama Landing Page
    public function index()
    {
        $hero = Hero::first();
        $banners = Banner::latest()->get();
        $testimonials = Testimonial::latest()->get();
        $projects = StudentProject::latest()->take(6)->get(); 
        
        return view('landing_page.index', compact('hero', 'banners', 'testimonials', 'projects'));
    }

    // 2. Fungsi Menampilkan Halaman Form Booking (Halaman Baru)
    public function showBookingForm()
    {
        return view('landing_page.sections.form-pendaftaran');
    }

    // 3. Fungsi Kirim Data ke Google Sheets
    public function storeBooking(Request $request)
    {
        // 1. Validasi data
        $request->validate([
            'name'  => 'required|string|max:255',
            'phone' => 'required',
            'email' => 'required|email',
        ]);

        // 2. SIMPAN KE DATABASE (Agar muncul di Admin)
        // Ini bagian yang bikin datanya muncul di dashboard admin kamu
        FreeTrial::create([
            'prefix'    => $request->prefix,
            'name'      => $request->name,
            'country'   => $request->country,
            'phone'     => $request->phone,
            'email'     => $request->email,
            'kids_list' => $request->kids_list,
            'message'   => $request->message,
        ]);

        // 3. KIRIM KE GOOGLE SHEETS (Seperti yang sudah jalan)
        $googleSheetUrl = "https://script.google.com/macros/s/AKfycbzpnO_tM6fpa0cXkjFKC2UpPCitiWLI_0dw-cZrkIpbZDbjaUGDRar4vrOZGmWr_uhWbQ/exec";
        $response = Http::withOptions(['verify' => false])->post($googleSheetUrl, [
            'action'    => 'INSERT',
            'prefix'    => $request->prefix,
            'name'      => $request->name,
            'country'   => $request->country,
            'phone'     => $request->phone,
            'email'     => $request->email,
            'kids_list' => $request->kids_list,
            'message'   => $request->message,
        ]);

        if ($response->successful()) {
            return back()->with('success', 'Berhasil! Data masuk ke Database & Google Sheets.');
        }

        return back()->with('error', 'Database masuk, tapi gagal kirim ke Sheets.');
    }
}