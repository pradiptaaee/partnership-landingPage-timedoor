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

    public function destroy($id)
    {
        $trial = FreeTrial::findOrFail($id);
        $googleSheetUrl = "https://script.google.com/macros/s/AKfycbzpnO_tM6fpa0cXkjFKC2UpPCitiWLI_0dw-cZrkIpbZDbjaUGDRar4vrOZGmWr_uhWbQ/exec";

        // Kirim sinyal hapus ke Google Sheets
        try {
            Http::withOptions(['verify' => false])->post($googleSheetUrl, [
                'action' => 'DELETE',
                'email'  => $trial->email // Pake email sebagai kunci penghapusan
            ]);
        } catch (\Exception $e) {
            // Kalau google error, tetep lanjut hapus di lokal atau kasih log
        }

        // Hapus di Database Lokal
        $trial->delete();

        return back()->with('success', 'Data berhasil dihapus dari Admin & Google Sheets!');
    }
}