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
     * LOGIC UTAMA: INDO -> INGGRIS -> DUNIA
     */
    private function processTranslation($inputArray)
    {
        // 1. Ambil input Bahasa Indonesia
        $indoText = $inputArray['id'] ?? '';

        if (empty($indoText)) {
            return $inputArray; 
        }

        $tr = new GoogleTranslate();

        // 2. Translate INDO -> INGGRIS (Jembatan Kualitas)
        $englishText = '';
        try {
            $tr->setSource('id'); 
            $tr->setTarget('en');
            $englishText = $tr->translate($indoText);
            
            // Simpan hasil Inggris ke array
            $inputArray['en'] = $englishText; 
        } catch (\Exception $e) {
            $englishText = $indoText; // Fallback
            $inputArray['en'] = $indoText;
        }

        // 3. Translate INGGRIS -> JEPANG, ARAB, DLL
        $targets = ['ms' => 'ms', 'fil' => 'tl', 'ja' => 'ja', 'ar' => 'ar', 'bn' => 'bn'];

        foreach ($targets as $laravelCode => $googleCode) {
            if (empty($inputArray[$laravelCode])) {
                try {
                    $tr->setSource('en'); // Sumber dari Inggris biar akurat
                    $tr->setTarget($googleCode);
                    $inputArray[$laravelCode] = $tr->translate($englishText);
                } catch (\Exception $e) {
                    $inputArray[$laravelCode] = $englishText;
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
        $request->validate([
            'image'          => 'required|image|max:2048',
            'title.id'       => 'required|string', // Validasi ID
            'description.id' => 'required|string', // Validasi ID
        ]);

        $titles = $this->processTranslation($request->title);
        $descriptions = $this->processTranslation($request->description);
        $imagePath = $request->file('image')->store('banners', 'public');

        Banner::create([
            'image'       => $imagePath,
            'title'       => $titles,
            'description' => $descriptions,
        ]);

        return redirect()->route('admin.banners.index')->with('success', 'Banner berhasil dibuat!');
    }

    public function edit(Banner $banner)
    {
        return view('admin.landing_page.banners.edit', compact('banner'));
    }

    public function update(Request $request, Banner $banner)
    {
        $request->validate([
            'image'          => 'nullable|image|max:2048',
            'title.id'       => 'required|string',
            'description.id' => 'required|string',
        ]);

        $data = $request->except(['image', 'title', 'description']);
        
        $titles = $this->processTranslation($request->title);
        $descriptions = $this->processTranslation($request->description);
        
        $data['title'] = $titles;
        $data['description'] = $descriptions;

        if ($request->hasFile('image')) {
            if ($banner->image && Storage::disk('public')->exists($banner->image)) {
                Storage::disk('public')->delete($banner->image);
            }
            $data['image'] = $request->file('image')->store('banners', 'public');
        }

        $banner->update($data);

        return redirect()->route('admin.banners.index')->with('success', 'Banner berhasil diperbarui!');
    }

    public function destroy(Banner $banner)
    {
        if ($banner->image && Storage::disk('public')->exists($banner->image)) {
            Storage::disk('public')->delete($banner->image);
        }
        $banner->delete();
        return redirect()->route('admin.banners.index')->with('success', 'Banner dihapus.');
    }
}