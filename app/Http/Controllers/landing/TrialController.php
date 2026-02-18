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

    /**
     * Store booking (POST /trial)
     */
    public function storeBooking(Request $request)
    {
        // Tambahkan semua field ke validasi agar Laravel memberi tahu jika ada yang kurang
        $request->validate([
            'prefix'    => 'required',
            'name'      => 'required',
            'country'   => 'required',
            'phone'     => 'required',
            'email'     => 'required|email',
            'kids_list' => 'required',
        ]);

        try {
            // Simpan ke database
            $freeTrial = FreeTrial::create($request->all());

            // URL Google Sheets
            $googleSheetUrl = "https://script.google.com/macros/s/AKfycbxMsES88FIn7xA9obdzEZvQ8Kpc5hlrp0buwp48A87qwuPoQBapjVql0J2Wng46z5vJHg/exec";

            // Gunakan pengiriman asinkron atau log error jika Sheets gagal
            $response = Http::asForm()
                ->withOptions(['allow_redirects' => true])
                ->timeout(15) // Kurangi sedikit timeout agar user tidak menunggu terlalu lama
                ->post($googleSheetUrl, [
                    'action'    => 'INSERT',
                    'id'        => $freeTrial->id,
                    'prefix'    => $request->prefix,
                    'name'      => $request->name,
                    'country'   => $request->country,
                    'phone'     => $request->phone,
                    'email'     => $request->email,
                    'kids_list' => $request->kids_list,
                    'message'   => $request->message,
                ]);

            if ($response->successful()) {
                return redirect()->back()->with('success', 'Pendaftaran Berhasil!');
            }

            return redirect()->back()->with('success', 'Data tersimpan di sistem, namun gagal sinkron ke Sheets.');
        } catch (\Exception $e) {
            // PENTING: Lihat error aslinya di log
            \log::error('Gagal Booking: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan sistem: ' . $e->getMessage());
        }
    }
}
