<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; // Wajib import untuk hapus/cek file

class TestimonialController extends Controller
{
    /**
     * Menampilkan daftar testimoni.
     */
    public function index()
    {
        // Mengambil data urut dari yang terbaru
        $testimonials = Testimonial::latest()
                    ->filter(request(['search', 'sort'])) 
                    ->get();
        
        // Pastikan Anda sudah membuat view index ini
        return view('admin.landing_page.testimonials.index', compact('testimonials'));
    }

    /**
     * Menampilkan form tambah testimoni.
     */
    public function create()
    {
        return view('admin.landing_page.testimonials.create');
    }

    /**
     * Menyimpan data testimoni baru ke database.
     */
    public function store(Request $request)
    {
        // 1. Validasi Input
        $validatedData = $request->validate([
            'parent_name'  => 'required|string|max:255',
            'student_name' => 'nullable|string|max:255',
            'course_name'  => 'nullable|string|max:255',
            'review'       => 'required|string', // Sesuai model Anda
            'parent_image' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048', // Sesuai model Anda
        ], [
            'parent_name.required'  => 'Nama Orang Tua wajib diisi.',
            'review.required'       => 'Isi testimoni tidak boleh kosong.',
            'parent_image.required' => 'Foto wajib diupload.',
            'parent_image.image'    => 'File harus berupa gambar.',
            'parent_image.max'      => 'Ukuran gambar maksimal 2MB.',
        ]);

        // 2. Handle Upload Gambar
        if ($request->hasFile('parent_image')) {
            // Upload ke folder storage/app/public/testimonials
            $validatedData['parent_image'] = $request->file('parent_image')->store('testimonials', 'public');
        }

        // 3. Simpan ke Database
        Testimonial::create($validatedData);

        // 4. Redirect kembali dengan pesan sukses
        return redirect()
            ->route('admin.testimonials.index')
            ->with('success', 'Testimoni berhasil ditambahkan!');
    }

    /**
     * Menampilkan form edit testimoni.
     */
    public function edit(Testimonial $testimonial)
    {
        return view('admin.landing_page.testimonials.edit', compact('testimonial'));
    }

    /**
     * Mengupdate data testimoni di database.
     */
    public function update(Request $request, Testimonial $testimonial)
    {
        // 1. Validasi Input
        $validatedData = $request->validate([
            'parent_name'  => 'required|string|max:255',
            'student_name' => 'nullable|string|max:255',
            'course_name'  => 'nullable|string|max:255',
            'review'       => 'required|string',
            'parent_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048', // Nullable karena user mungkin tidak ganti foto
        ]);

        // 2. Handle Upload Gambar (Jika user upload foto baru)
        if ($request->hasFile('parent_image')) {
            
            // Hapus gambar lama dari storage agar hemat memori
            if ($testimonial->parent_image && Storage::disk('public')->exists($testimonial->parent_image)) {
                Storage::disk('public')->delete($testimonial->parent_image);
            }

            // Upload gambar baru
            $validatedData['parent_image'] = $request->file('parent_image')->store('testimonials', 'public');
        }

        // 3. Update Database
        $testimonial->update($validatedData);

        // 4. Redirect
        return redirect()
            ->route('admin.testimonials.index')
            ->with('success', 'Testimoni berhasil diperbarui!');
    }

    /**
     * Menghapus testimoni dari database.
     */
    public function destroy(Testimonial $testimonial)
    {
        // 1. Hapus file gambar fisiknya dulu
        if ($testimonial->parent_image && Storage::disk('public')->exists($testimonial->parent_image)) {
            Storage::disk('public')->delete($testimonial->parent_image);
        }

        // 2. Hapus data dari database
        $testimonial->delete();

        // 3. Redirect
        return redirect()
            ->route('admin.testimonials.index')
            ->with('success', 'Testimoni berhasil dihapus!');
    }
}