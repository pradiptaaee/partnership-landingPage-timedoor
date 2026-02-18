<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Hero;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HeroController extends Controller
{
    /**
     * Display hero index page.
     */
    public function index() 
    {
        $hero = Hero::firstOrCreate([], [
            'hero_title' => 'Default Title',
            'hero_desc'  => 'Default Description'
        ]);

        return view('admin.landing_page.hero.index', compact('hero'));
    }

    /**
     * Show hero edit form.
     */
    public function edit()
    {
        $hero = Hero::firstOrCreate([], [
            'hero_title' => 'Default Title',
            'hero_desc'  => 'Default Description'
        ]);

        return view('admin.landing_page.hero.edit', compact('hero'));
    }

    /**
     * Update hero content and localized banners.
     */
    public function update(Request $request)
    {
        $hero = Hero::first();

        $request->validate([
            'hero_title'    => 'nullable|string',
            'hero_subtitle' => 'nullable|string',
            'hero_desc'     => 'nullable|string',
            'image_*'       => 'nullable|image|max:3000',
        ]);

        // Update text content
        $hero->fill($request->only(['hero_title', 'hero_subtitle', 'hero_desc']));

        // Process localized banners based on config
        foreach (config('landing.languages') as $lang) {
            $column = 'image_' . $lang['code'];

            if ($request->hasFile($column)) {
                // Cleanup old file
                if ($hero->$column && Storage::disk('public')->exists($hero->$column)) {
                    Storage::disk('public')->delete($hero->$column);
                }

                $hero->$column = $request->file($column)->store('hero', 'public');
            }
        }

        $hero->save();

        return redirect()->back()->with('success_message', 'Hero Section updated successfully!');
    }
}