<?php

namespace App\Http\Controllers\landing;

use App\Http\Controllers\Controller;
use App\Models\FreeTrial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class TrialController extends BasePageController
{
    /**
     * Display form page
     */
    public function index()
    {
        $currentLangData = $this->getCurrentLanguageData();
        return view('landing_page.form.trial', compact('currentLangData'));
    }

    public function storeBooking(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required', // Tambahkan ini agar aman
        ]);

        try {
            // 1. Simpan ke database lokal
            $freeTrial = FreeTrial::create($request->all());

            // 2. Kirim ke Google Sheets
            $googleSheetUrl = "https://script.google.com/macros/s/AKfycbxMsES88FIn7xA9obdzEZvQ8Kpc5hlrp0buwp48A87qwuPoQBapjVql0J2Wng46z5vJHg/exec";

            $response = Http::asForm()
                ->withOptions(['allow_redirects' => true])
                ->timeout(20)
                ->post($googleSheetUrl, [
                    'action' => 'INSERT',
                    'id' => $freeTrial->id,
                    'prefix' => $request->prefix,
                    'name' => $request->name,
                    'country' => $request->country,
                    'phone' => $request->phone,
                    'email' => $request->email,
                    'kids_list' => $request->kids_list,
                    'message' => $request->message,
                ]);

            if ($response->successful()) {
                return redirect()->back()->with('success', __('trial_success_msg'));
            }

            return redirect()->back()->with('success', __('trial_partial_success_msg'));
        } catch (\Exception $e) {
            // Log error untuk mempermudah diagnosa jika gagal
            \Log::error("Trial Error: " . $e->getMessage());
            return redirect()->back()->with('error', __('trial_error_msg'));
        }
    }

    /**
     * Store booking (POST /trial)
     */
    
}
