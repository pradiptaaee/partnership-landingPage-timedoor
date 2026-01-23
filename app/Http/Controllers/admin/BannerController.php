<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Stichoza\GoogleTranslate\GoogleTranslate; // Pastikan package ini sudah diinstall

class BannerController extends Controller
{
    /**
     * LOGIC TRANSLASI OTOMATIS
     * Sumber: Inggris (en) -> Target: Indo (id), Jepang (ja), dll.
     */
    private function processTranslation($inputArray)
    {
        // 1. Ambil teks sumber (Dari input 'en' di Form)
        $sourceText = $inputArray['en'] ?? '';

        // Jika tidak ada teks inggris, kembalikan array apa adanya
        if (empty($sourceText)) {
            return $inputArray;
        }

        // 2. Siapkan Google Translate
        $tr = new GoogleTranslate();
        $tr->setSource('en'); // Set sumber bahasa Inggris

        // 3. Daftar Bahasa Tujuan (Format: 'kode_laravel' => 'kode_google')
        $targets = [
            'id'  => 'id',  // Indonesia
            'ja'  => 'ja',  // Jepang
            'ar'  => 'ar',  // Arab
            'ms'  => 'ms',  // Melayu
            'fil' => 'tl',  // Tagalog (Google pakai 'tl')
            'bn'  => 'bn',  // Bengali
        ];

        // 4. Loop untuk translate ke bahasa yang kosong
        foreach ($targets as $langKey => $googleCode) {
            // Jika user tidak mengisi manual bahasa tersebut, kita translate otomatis
            if (empty($inputArray[$langKey])) {
                try {
                    $tr->setTarget($googleCode);
                    $inputArray[$langKey] = $tr->translate($sourceText);
                } catch (\Exception $e) {
                    // Jika gagal translate (misal koneksi error), pakai teks inggrisnya saja
                    $inputArray[$langKey] = $sourceText;
                }
            }
        }

        return $inputArray;
    }

    public function index()
    {
        $banners = Banner::latest()->get();
        return view('admin.landing_page.banners.index', compact('banners'));
    }

    public function create()
    {
        return view('admin.landing_page.banners.create');
    }

    public function store(Request $request)
    {
        // 1. Validasi (Sesuai name di Form: title[en], description[en])
        $request->validate([
            'image'          => 'required|image|max:2048',
            'title.en'       => 'required|string', 
            'description.en' => 'required|string',
        ], [
            'title.en.required'       => 'Judul (Bahasa Inggris) wajib diisi.',
            'description.en.required' => 'Deskripsi (Bahasa Inggris) wajib diisi.',
            'image.required'          => 'Wajib upload gambar banner.',
        ]);

        // 2. Proses Auto-Translate
        // Kita kirim array title['en']..., fungsi ini akan melengkapi ['id'], ['ja'], dll.
        $titles = $this->processTranslation($request->title);
        $descriptions = $this->processTranslation($request->description);

        // 3. Upload Gambar
        $imagePath = $request->file('image')->store('banners', 'public');

        // 4. Simpan ke Database
        Banner::create([
            'image'       => $imagePath,
            'title'       => $titles,       // Disimpan sebagai JSON otomatis (karena casts di Model)
            'description' => $descriptions, // Disimpan sebagai JSON otomatis
            
            // 'is_active'   => true
        ]);

        return redirect()->route('admin.banners.index')->with('success_message', 'Banner berhasil dibuat & diterjemahkan  otomatis!');
    }

    public function edit(Banner $banner)
    {
        return view('admin.landing_page.banners.edit', compact('banner'));
    }

    public function update(Request $request, Banner $banner)
    {
        // 1. Validasi Update
        $request->validate([
            'image'          => 'nullable|image|max:2048',
            'title.en'       => 'required|string',
            'description.en' => 'required|string',
        ]);

        $data = $request->except(['image', 'title', 'description']);
        
        // 2. Proses Translate Ulang (Jika diedit)
        $titles = $this->processTranslation($request->title);
        $descriptions = $this->processTranslation($request->description);
        
        $data['title'] = $titles;
        $data['description'] = $descriptions;

        // 3. Cek Ganti Gambar
        if ($request->hasFile('image')) {
            // Hapus gambar lama
            if ($banner->image && Storage::disk('public')->exists($banner->image)) {
                Storage::disk('public')->delete($banner->image);
            }
            $data['image'] = $request->file('image')->store('banners', 'public');
        }

        $banner->update($data);

        return redirect()->route('admin.banners.index')->with('success_message', 'Banner berhasil diperbarui!');
    }

    public function destroy(Banner $banner)
    {
        if ($banner->image && Storage::disk('public')->exists($banner->image)) {
            Storage::disk('public')->delete($banner->image);
        }
        $banner->delete();
        return redirect()->back()->with('success_message', 'Banner dihapus.');
    }
}