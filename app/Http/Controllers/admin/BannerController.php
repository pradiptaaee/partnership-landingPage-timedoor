<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Stichoza\GoogleTranslate\GoogleTranslate;

class BannerController extends Controller
{
    /**
     * Logika translasi otomatis untuk kolom terlokalisasi.
     */
    private function processTranslation($inputArray)
    {
        // Identifikasi bahasa sumber (id atau en)
        $sourceLanguage = isset($inputArray['id']) ? 'id' : (isset($inputArray['en']) ? 'en' : null);
        $sourceText = $sourceLanguage ? $inputArray[$sourceLanguage] : null;

        if (empty($sourceText)) return $inputArray;

        $tr = new GoogleTranslate();
        $tr->setSource($sourceLanguage);

        $languages = config('landing.languages');

        foreach ($languages as $lang) {
            $code = $lang['code'];
            
            // Terjemahkan jika kolom target kosong
            if (empty($inputArray[$code])) {
                try {
                    $googleCode = ($code === 'fil') ? 'tl' : $code;
                    $tr->setTarget($googleCode);
                    $inputArray[$code] = $tr->translate($sourceText);
                } catch (\Exception $e) {
                    $inputArray[$code] = $sourceText;
                }
            }
        }

        return $inputArray;
    }

    /**
     * Tampilkan daftar banner.
     */
    public function index()
    {
        $banners = Banner::latest()->get();
        return view('admin.landing_page.banners.index', compact('banners'));
    }

    /**
     * Form tambah banner baru.
     */
    public function create()
    {
        return view('admin.landing_page.banners.create');
    }

    /**
     * Simpan data banner baru ke database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'image'          => 'required|image|max:2048',
            'title.en'       => 'required|string', 
            'description.en' => 'required|string',
        ]);

        $titles = $this->processTranslation($request->title);
        $descriptions = $this->processTranslation($request->description);

        Banner::create([
            'image'       => $request->file('image')->store('banners', 'public'),
            'title'       => $titles,
            'description' => $descriptions,
        ]);

        return redirect()->route('admin.banners.index')->with('success_message', 'Banner berhasil dibuat.');
    }

    /**
     * Form edit data banner.
     */
    public function edit(Banner $banner)
    {
        return view('admin.landing_page.banners.edit', compact('banner'));
    }

    /**
     * Perbarui data banner di database.
     */
    public function update(Request $request, Banner $banner)
    {
        $request->validate([
            'image'          => 'nullable|image|max:2048',
            'title.id'       => 'required|string',
            'description.id' => 'required|string',
        ]);

        $titles = $this->processTranslation($request->title);
        $descriptions = $this->processTranslation($request->description);
        
        $data = [
            'title'       => $titles,
            'description' => $descriptions,
        ];

        // Kelola penggantian file gambar
        if ($request->hasFile('image')) {
            if ($banner->image) Storage::disk('public')->delete($banner->image);
            $data['image'] = $request->file('image')->store('banners', 'public');
        }

        $banner->update($data);

        return redirect()->route('admin.banners.index')->with('success_message', 'Banner berhasil diperbarui.');
    }

    /**
     * Hapus data banner dari database dan storage.
     */
    public function destroy(Banner $banner)
    {
        if ($banner->image) Storage::disk('public')->delete($banner->image);
        $banner->delete();
        
        return redirect()->back()->with('success_message', 'Banner berhasil dihapus.');
    }
}