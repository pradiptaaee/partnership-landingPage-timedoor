<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Partner;
use App\Models\PartnerActivity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


class PartnerAdminController extends Controller
{
    public function index(Request $request)
    {
        $query = Partner::query();

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }


        switch ($request->input('sort', 'latest')) { 
            case 'oldest':
                $query->oldest(); 
                break;
            case 'name_asc':
                $query->orderBy('name', 'asc'); 
                break;
            case 'name_desc':
                $query->orderBy('name', 'desc'); 
                break;
            default: // 'latest'
                $query->latest(); 
                break;
        }

        $partners = $query->paginate(5);

        $totalPartners = Partner::count();
        $totalCategories = Partner::distinct('category')->count('category');
        $totalActivities = PartnerActivity::count();

        return view('admin.partners.index');
    }

    public function show(Partner $partner)
    {
        
        $totalPartners = Partner::count();

        $totalCategories = Partner::distinct('category')->count('category');

        $totalActivities = PartnerActivity::count();

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
            'email' => 'nullable|string',
            'no_telepon' => 'nullable|string',
            'logo' => 'nullable|image|max:2048'
        ]);

        
        // Slug otomatis dari model
        $partner = new Partner();
        $partner->name = $validated['name'];
        $partner->category = $validated['category'];
        $partner->description = $validated['description'];
        $partner->email = $validated['email'] ?? null;
        $partner->no_telepon = $validated['no_telepon'] ?? null;
        $partner->slug = Str::slug($validated['name']);

        // Upload logo 
        if ($request->hasFile('logo')) {
            $fileName = time() . '_' . $request->file('logo')->getClientOriginalName();
            $request->file('logo')->storeAs('public/partner/logo', $fileName);
            $partner->logo = 'partner/logo/' . $fileName;
        }

        Session::flash('success_message', 'Partner baru berhasil ditambahkan!');

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
            'email' => 'nullable|string',
            'no_telepon' => 'nullable|string',
            'logo' => 'nullable|image|max:2048'
        ]);

        $partner->name = $validated['name'];
        $partner->category = $validated['category'];
        $partner->description = $validated['description'];
        $partner->email = $validated['email'] ?? null;
        $partner->no_telepon = $validated['no_telepon'] ?? null;
        $partner->slug = Str::slug($validated['name']);

        if ($request->hasFile('logo')) {

            // Hapus logo lama 
            if ($partner->logo && Storage::exists('public/' . $partner->logo)) {
                Storage::delete('public/' . $partner->logo);
            }

            // Upload logo baru
            $fileName = time() . '_' . $request->file('logo')->getClientOriginalName();
            $request->file('logo')->storeAs('public/partner/logo', $fileName);

            $partner->logo = 'partner/logo/' . $fileName;
        }

        Session::flash('success_message', 'Partner berhasil diperbarui!');

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
