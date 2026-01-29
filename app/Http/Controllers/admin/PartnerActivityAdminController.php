<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Partner;
use App\Models\PartnerActivity;
use App\Models\PhotoActivity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use App\Models\ActivitySeminarDetail;
use App\Models\ActivityWorkshopDetail;


class PartnerActivityAdminController extends Controller
{
    /**
     * Display all activities with optional filtering.
     */
    public function index(Request $request)
    {
        // Menggunakan PartnerActivity sebagai model (asumsi: sama dengan PartnerActivity::class)
        $query = PartnerActivity::with(['partner', 'photos']);

        // Filter by partner
        if ($request->filled('partner_id')) {
            $query->where('partner_id', $request->partner_id);
        }

        // Search by title
        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }


        // Sorting
        switch ($request->input('sort', 'latest')) {
            case 'oldest':
                $query->oldest();
                break;
            case 'title':
                $query->orderBy('title', 'asc');
                break;
            default: // latest
                $query->latest();
                break;
        }

        // Pagination: Set ke 3 item per halaman (sesuai setting Anda)
        $activities = $query->paginate(6);

        // --- PENYESUAIAN UNTUK AJAX LOAD MORE DIMULAI DI SINI ---

        // Cek apakah permintaan datang dari AJAX (klik tombol Load More)
        if ($request->ajax()) {

            // 1. Render partial view yang hanya berisi cards (tanpa layout)
            $html = view('admin.activity.partials.activity_cards', compact('activities'))->render();

            // 2. Kembalikan respons dalam format JSON
            return response()->json([
                'html' => $html,
                'next_page_url' => $activities->nextPageUrl(), // URL ke halaman selanjutnya
                'has_more' => $activities->hasMorePages(),      // Cek apakah masih ada halaman
            ]);
        }

        // Jika bukan permintaan AJAX (pemuatan halaman pertama kali)
        return view('admin.activity.index', compact('activities'));
    }




    /**
     * Show the form for creating a new activity.
     */
    public function create()
    {
        $partners = Partner::orderBy('name')->get();

        return view('admin.activity.create', compact('partners'));
    }

    /**
     * Store a newly created activity in storage.
     */
    public function store(Request $request)
    {
        $validated = $this->validateActivity($request);

        DB::beginTransaction();

        try {
            /**
             * =========================
             * SIMPAN ACTIVITY UTAMA
             * =========================
             */
            $activity = PartnerActivity::create([
                'partner_id' => $validated['partner_id'],
                'title' => $validated['title'],
                'slug' => $this->generateUniqueSlug($validated['title']),
                'category_activity' => $validated['category_activity'],
                'full_description' => $validated['full_description'],
                'activity_date' => $validated['activity_date'],
                'featured_image' => $this->storeFeaturedImage($request),
            ]);

            /**
             * =========================
             * SIMPAN DETAIL BERDASARKAN KATEGORI
             * =========================
             */
            $this->storeActivityDetail($activity, $validated);

            /**
             * =========================
             * SIMPAN GALERI FOTO
             * =========================
             */
            if ($request->hasFile('photos')) {
                $this->uploadPhotos($request->file('photos'), $activity->id);
            }

            DB::commit();

            return redirect()
                ->route('admin.activity.index')
                ->with('success_message', 'Kegiatan berhasil ditambahkan.');

        } catch (\Throwable $e) {
            DB::rollBack();

            return back()
                ->withInput()
                ->withErrors(['error' => $e->getMessage()]);
        }
    }



    public function show($slug)
    {
        $activity = PartnerActivity::with('photos', 'partner')
            ->where('slug', $slug)
            ->firstOrFail();

        return view('admin.activity.show', compact('activity'));
    }


    private string $featuredPath = 'activity/featured';
    private string $photosPath = 'activity/photos';
    /**
     * Show the form for editing the specified activity.
     */
    public function edit($id)
    {
        $activity = PartnerActivity::with('photos')->findOrFail($id);
        $partners = Partner::orderBy('name')->get();

        return view('admin.activity.edit', compact('activity', 'partners'));
    }

    /**
     * Update the specified activity in storage.
     */
    public function update(Request $request, $id)
    {
        $activity = PartnerActivity::findOrFail($id);
        $validated = $this->validateActivity($request, $id);

        DB::beginTransaction();

        try {
            /**
             * =========================
             * UPDATE ACTIVITY UTAMA
             * =========================
             */
            $activity->update([
                'partner_id' => $validated['partner_id'],
                'title' => $validated['title'],
                'slug' => $activity->isDirty('title')
                    ? $this->generateUniqueSlug($validated['title'], $id)
                    : $activity->slug,
                'full_description' => $validated['full_description'],
                'activity_date' => $validated['activity_date'],
                'featured_image' => $this->updateFeaturedImage($request, $activity),
            ]);

            /**
             * =========================
             * UPDATE DETAIL
             * =========================
             */
            $this->updateActivityDetail($activity, $validated, $request);

            /**
             * =========================
             * FOTO TAMBAHAN
             * =========================
             */
            if ($request->hasFile('photos')) {
                $this->uploadPhotos($request->file('photos'), $activity->id);
            }

            DB::commit();

            return redirect()
                ->route('admin.activity.index')
                ->with('success_message', 'Kegiatan berhasil diperbarui.');

        } catch (\Throwable $e) {
            DB::rollBack();

            return back()
                ->withInput()
                ->withErrors(['error' => $e->getMessage()]);
        }
    }


    /**
     * Remove the specified activity from storage.
     */
    public function destroy($id)
    {
        $activity = PartnerActivity::findOrFail($id);

        try {
            // Images will be deleted automatically via model boot method
            $activity->delete();

            return redirect()
                ->route('admin.activity.index')
                ->with('success', 'Kegiatan berhasil dihapus.');

        } catch (\Exception $e) {
            return back()
                ->withErrors(['error' => 'Gagal menghapus kegiatan: ' . $e->getMessage()]);
        }
    }

    /**
     * Delete individual photo from activity.
     */
    public function deletePhoto(PhotoActivity $photo)
    {
        try {
            // Dapatkan ID kegiatan yang terkait (untuk redirect yang lebih spesifik jika perlu)
            $activityId = $photo->partner_activity_id;

            // 1. Hapus file fisik dari storage
            $filePath = 'storage/activity/photos/' . $photo->image_path;
            Storage::disk('public')->delete($filePath);

            // 2. Hapus record database
            $photo->delete();

            // Berhasil: Flash pesan sukses ke session
            // Ini akan ditangkap oleh SweetAlert listener di layout admin
            return back()->with('success_alert', 'Foto berhasil dihapus dari galeri.');

        } catch (\Exception $e) {
            // Gagal: Flash pesan error ke session
            return back()->with('error_alert', 'Gagal menghapus foto. Error: ' . $e->getMessage());
        }
    }



    /**
     * Validate activity input.
     */
    private function validateActivity(Request $request): array
    {
        $rules = [
            'partner_id' => 'required|exists:partners,id',
            'title' => 'required|string|max:255',
            'category_activity' => 'required|string',
            'full_description' => 'required|string',
            'activity_date' => 'required|date',
            'featured_image' => 'nullable|image|max:2048',
            'photos.*' => 'nullable|image|max:2048',
        ];

        if ($request->category_activity === 'seminar') {
            $rules += [
                'speaker_name' => 'required|string|max:255',
                'speaker_about' => 'required|string',
                'speaker_photo' => 'required|image|max:1024',
            ];
        }

        if ($request->category_activity === 'workshop') {
            $rules += [
                'mentor_name' => 'required|string|max:255',
                'description' => 'required|string|max:255',
            ];
        }

        return $request->validate($rules);
    }

    private function storeActivityDetail(PartnerActivity $activity, array $validated): void
    {
        $category = strtolower($validated['category_activity']);

        if ($category === 'seminar') {
            $activity->seminarDetail()->create([
                'speaker_name' => $validated['speaker_name'],
                'speaker_about' => $validated['speaker_about'],
                'speaker_photo' => $this->storeSpeakerPhoto(request()),
            ]);
        }

        if ($category === 'workshop') {
            $activity->workshopDetail()->create([
                'mentor_name' => $validated['mentor_name'],
                'description' => $validated['description'],
            ]);
        }
    }
    private function updateActivityDetail(
        PartnerActivity $activity,
        array $data,
        Request $request
    ): void {
        if ($activity->category_activity === 'seminar') {

            $payload = [
                'speaker_name' => $data['speaker_name'],
                'speaker_about' => $data['speaker_about'],
            ];

            if ($request->hasFile('speaker_photo')) {

                // hapus foto lama
                if (
                    $activity->seminarDetail &&
                    $activity->seminarDetail->speaker_photo &&
                    Storage::disk('public')->exists('activity/speakers/' . $activity->seminarDetail->speaker_photo)
                ) {
                    Storage::disk('public')->delete(
                        'activity/speakers/' . $activity->seminarDetail->speaker_photo
                    );
                }

                // simpan foto baru
                $payload['speaker_photo'] = $this->storeSpeakerPhoto($request);
            }

            $activity->seminarDetail()->updateOrCreate(
                ['partner_activity_id' => $activity->id],
                $payload
            );
        }

        if ($activity->category_activity === 'workshop') {

            $activity->workshopDetail()->updateOrCreate(
                ['partner_activity_id' => $activity->id],
                [
                    'mentor_name' => $data['mentor_name'],
                    'description' => $data['description'],
                ]
            );
        }
    }

    private function storeFeaturedImage(Request $request): ?string
    {
        if (!$request->hasFile('featured_image')) {
            return null;
        }

        $file = $request->file('featured_image');
        $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

        $file->storeAs('activity/featured', $filename, 'public');

        return $filename; // ⬅️ HANYA NAMA FILE
    }

    private function updateFeaturedImage(Request $request, PartnerActivity $activity): ?string
    {
        if (!$request->hasFile('featured_image')) {
            return $activity->featured_image;
        }

        // Hapus file lama jika ada
        if (
            $activity->featured_image &&
            Storage::disk('public')->exists($this->featuredPath . '/' . $activity->featured_image)
        ) {
            Storage::disk('public')->delete($this->featuredPath . '/' . $activity->featured_image);
        }

        $file = $request->file('featured_image');
        $filename = uniqid() . '.' . $file->getClientOriginalExtension();

        $file->storeAs($this->featuredPath, $filename, 'public');

        return $filename; // ⬅️ hanya nama file
    }
    private function storeSpeakerPhoto(Request $request): ?string
    {
        if (!$request->hasFile('speaker_photo')) {
            return null;
        }

        $file = $request->file('speaker_photo');
        $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

        $file->storeAs('activity/speakers', $filename, 'public');

        return $filename; // ⬅️ hanya nama file
    }



    /**
     * Generate unique slug from title.
     */
    private function generateUniqueSlug($title, $excludeId = null)
    {
        $slug = Str::slug($title);
        $originalSlug = $slug;
        $counter = 1;

        while (true) {
            $query = PartnerActivity::where('slug', $slug);

            if ($excludeId) {
                $query->where('id', '!=', $excludeId);
            }

            if (!$query->exists()) {
                break;
            }

            $slug = $originalSlug . '-' . $counter;
            $counter++;
        }

        return $slug;
    }

    /**
     * Upload single image.
     */
    private function uploadImage($file, $folder)
    {
        $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

        $file->storeAs($folder, $fileName, 'public');

        return $fileName;
    }



    /**
     * Upload multiple photos.
     */
    private function uploadPhotos($photos, int $activityId): void
    {
        foreach ($photos as $photo) {
            $filename = time() . '_' . uniqid() . '.' . $photo->getClientOriginalExtension();

            $photo->storeAs('activity/photos', $filename, 'public');

            PhotoActivity::create([
                'partner_activity_id' => $activityId,
                'image_path' => $filename, // ⬅️ hanya filename
            ]);
        }
    }

}