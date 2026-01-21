<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Hero; // Panggil Model Hero
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HeroController extends Controller
{
    public function index() 
    {
        $hero = Hero::firstOrCreate([], [
        'hero_title' => 'Default Title',
        'hero_desc' => 'Default Description'
    ]);

    return view('admin.landing_page.hero.index', compact('hero'));
    }
    public function edit()
    {
        // Ambil data hero pertama. Jika belum ada, buat baru otomatis.
        $hero = Hero::firstOrCreate([], [
            'hero_title' => 'Default Title',
            'hero_desc' => 'Default Description'
        ]);

        return view('admin.landing_page.hero.edit', compact('hero'));
    }

    public function update(Request $request)
    {
        $hero = Hero::first();

        $locales = ['id', 'en', 'ja', 'ar', 'bn', 'fil', 'ms'];

        $request->validate([
            'hero_title' => 'nullable|string',
            'hero_desc'  => 'nullable|string',
            'image_*'    => 'nullable|image|max:3000',
        ]);

        if ($request->has('hero_title')) $hero->hero_title = $request->hero_title;
        if ($request->has('hero_subtitle')) $hero->hero_subtitle = $request->hero_subtitle;
        if ($request->has('hero_desc')) $hero->hero_desc = $request->hero_desc;

        foreach ($locales as $lang) {
            $column = 'image_' . $lang;

            if ($request->hasFile($column)) {
                if ($hero->{$column} && Storage::exists('public/' . $hero->{$column})) {
                    Storage::delete('public/' . $hero->{$column});
                }

                $filePath = $request->file($column)->store('hero', 'public');
                $hero->{$column} = $filePath;
            }
        }

        $hero->save();

        return redirect()->back()->with('success', 'Hero Banner berhasil diupdate!');
    }
}