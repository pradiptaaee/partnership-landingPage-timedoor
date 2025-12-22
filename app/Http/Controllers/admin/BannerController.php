<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; // Wajib import ini untuk urus file

class BannerController extends Controller
{
    // Menampilkan daftar banner
    public function index()
    {
        $banners = Banner::latest()
                ->filter(request(['search', 'sort'])) // Panggil scopeFilter tadi
                ->get();

        return view('admin.landing_page.banners.index', compact('banners'));
    }

    // Form tambah banner
    public function create()
    {
        return view('admin.landing_page.banners.create');
    }

    // Proses simpan ke database
    public function store(Request $request)
    {
        // 1. Validasi
        $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048', // Max 2MB
        ]);

        // 2. Upload Gambar
        // Gambar disimpan di folder: storage/app/public/banners
        $imagePath = $request->file('image')->store('banners', 'public');

        // 3. Simpan ke Database
        Banner::create([
            'title' => $request->title,
            'image' => $imagePath,
        ]);

        return redirect()->route('admin.banners.index')
                         ->with('success', 'Banner berhasil ditambahkan!');
    }

    // Form edit banner
    public function edit(Banner $banner)
    {
        return view('admin.landing_page.banners.edit', compact('banner'));
    }

    // Proses update database
    public function update(Request $request, Banner $banner)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Nullable karena kalau tidak ganti gambar, tidak apa2
        ]);

        $data = ['title' => $request->title];

        // Cek jika user upload gambar baru
        if ($request->hasFile('image')) {
            // Hapus gambar lama dulu agar tidak numpuk sampah
            if ($banner->image && Storage::disk('public')->exists($banner->image)) {
                Storage::disk('public')->delete($banner->image);
            }
            // Upload gambar baru
            $data['image'] = $request->file('image')->store('banners', 'public');
        }

        $banner->update($data);

        return redirect()->route('admin.banners.index')
                         ->with('success', 'Banner berhasil diperbarui!');
    }

    // Hapus banner
    public function destroy(Banner $banner)
    {
        // Hapus file gambarnya juga
        if ($banner->image && Storage::disk('public')->exists($banner->image)) {
            Storage::disk('public')->delete($banner->image);
        }

        $banner->delete();

        return redirect()->route('admin.banners.index')
                         ->with('success', 'Banner berhasil dihapus!');
    }
}