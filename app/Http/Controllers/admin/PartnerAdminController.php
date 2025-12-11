<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Partner;
use App\Models\PartnerActivity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


class PartnerAdminController extends Controller
{
    public function index()
    {
        $partners = Partner::latest()->paginate(5);

        $totalPartners = Partner::count();

        // Total Kategori UNIK (Menggunakan kolom 'category' di tabel partners)
        $totalCategories = Partner::distinct('category')->count('category');

        // Total Kegiatan (Menggunakan model PartnerActivity)
        $totalActivities = PartnerActivity::count();
        return view('admin.partners.index', compact('partners',
            'totalPartners',
            'totalCategories',
            'totalActivities'));
    }

    public function show(Partner $partner)
    {
        // 1. Ambil data statistik yang diminta

        // Total Partner (Menggunakan model Partner)
        $totalPartners = Partner::count();

        // Total Kategori UNIK (Menggunakan kolom 'category' di tabel partners)
        $totalCategories = Partner::distinct('category')->count('category');

        // Total Kegiatan (Menggunakan model PartnerActivity)
        $totalActivities = PartnerActivity::count();

        // 2. Tampilkan view detail (misalnya: admin.partners.show_detail atau admin.partners.show)
        return view('admin.partners.show', compact(
            'partner',
            'totalPartners',
            'totalCategories',
            'totalActivities'
        ));
    }

    public function create()
    {
        return view('admin.partners.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|unique:partners,name',
            'category' => 'required',
            'description' => 'required',
            'logo' => 'nullable|image|max:2048'
        ]);

        
        // Slug otomatis dari model
        $partner = new Partner();
        $partner->name = $validated['name'];
        $partner->category = $validated['category'];
        $partner->description = $validated['description'];
        $partner->slug = Str::slug($validated['name']);

        // Upload logo hanya jika ada file
        if ($request->hasFile('logo')) {
            $fileName = time() . '_' . $request->file('logo')->getClientOriginalName();
            $request->file('logo')->storeAs('public/partner/logo', $fileName);
            $partner->logo = 'partner/logo/' . $fileName;
        }

        $partner->save();

        return redirect()->route('admin.partners.index')->with('success', 'Partner berhasil ditambahkan');
    }

    public function edit(Partner $partner)
    {
        return view('admin.partners.edit', compact('partner'));
    }


    public function update(Request $request, $id)
    {
        $partner = Partner::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|unique:partners,name,' . $partner->id,
            'category' => 'required',
            'description' => 'required',
            'logo' => 'nullable|image|max:2048'
        ]);

        $partner->name = $validated['name'];
        $partner->category = $validated['category'];
        $partner->description = $validated['description'];

        // Jika upload logo baru
        if ($request->hasFile('logo')) {

            // Hapus logo lama — hanya jika ada logo lama
            if ($partner->logo && Storage::exists('public/' . $partner->logo)) {
                Storage::delete('public/' . $partner->logo);
            }

            // Upload logo baru
            $fileName = time() . '_' . $request->file('logo')->getClientOriginalName();
            $request->file('logo')->storeAs('public/partner/logo', $fileName);

            $partner->logo = 'partner/logo/' . $fileName;
        }

        // Jika tidak upload logo → biarkan logo lama

        $partner->save();

        return redirect()->route('admin.partners.index')->with('success', 'Partner berhasil diupdate');
    }


    public function destroy(Partner $partner)
    {
        if ($partner->logo && Storage::disk('public')->exists($partner->logo)) {
            Storage::disk('public')->delete($partner->logo);
        }

        $partner->delete();

        return redirect()
            ->route('admin.partners.index')
            ->with('success', 'Partner berhasil dihapus.');
    }
}
