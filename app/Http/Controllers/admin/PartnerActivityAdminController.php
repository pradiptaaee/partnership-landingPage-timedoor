<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Partner;
use App\Models\PartnerActivity;
use App\Models\PhotoActivity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class PartnerActivityAdminController extends Controller
{
    /**
     * Display all activities with optional filtering.
     */
    public function index(Request $request)
    {
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

        $activities = $query->paginate(15);

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
        // Validate input
        $validated = $this->validateActivity($request);

        DB::beginTransaction();
        try {
            // Create activity
            $activity = new PartnerActivity();
            $activity->partner_id = $validated['partner_id'];
            $activity->title = $validated['title'];
            $activity->slug = $this->generateUniqueSlug($validated['title']);
            $activity->short_description = $validated['short_description'];
            $activity->full_description = $validated['full_description'];
            $activity->activity_date = $validated['activity_date'];

            // Handle featured image upload
            if ($request->hasFile('featured_image')) {
                $activity->featured_image = $this->uploadImage(
                    $request->file('featured_image'),
                    'partner_activities'
                );
            }

            $activity->save();

            // Handle multiple photos upload
            if ($request->hasFile('photos')) {
                $this->uploadPhotos($request->file('photos'), $activity->id);
            }

            DB::commit();

            return redirect()
                ->route('admin.activity.index')
                ->with('success', 'Kegiatan berhasil ditambahkan.');

        } catch (\Exception $e) {
            DB::rollBack();

            // Delete uploaded images if transaction fails
            if (isset($activity->featured_image)) {
                Storage::disk('public')->delete($activity->featured_image);
            }

            return back()
                ->withInput()
                ->withErrors(['error' => 'Gagal menyimpan kegiatan: ' . $e->getMessage()]);
        }
    }

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

        // Validate input
        $validated = $this->validateActivity($request, $id);

        DB::beginTransaction();
        try {
            // Update basic information
            $activity->partner_id = $validated['partner_id'];
            $activity->title = $validated['title'];
            $activity->short_description = $validated['short_description'];
            $activity->full_description = $validated['full_description'];
            $activity->activity_date = $validated['activity_date'];

            // Update slug if title changed
            if ($activity->isDirty('title')) {
                $activity->slug = $this->generateUniqueSlug($validated['title'], $id);
            }

            // Handle featured image replacement
            if ($request->hasFile('featured_image')) {
                // Delete old featured image
                if ($activity->featured_image) {
                    Storage::disk('public')->delete($activity->featured_image);
                }

                $activity->featured_image = $this->uploadImage(
                    $request->file('featured_image'),
                    'partner_activities'
                );
            }

            $activity->save();

            // Handle additional photos upload
            if ($request->hasFile('photos')) {
                $this->uploadPhotos($request->file('photos'), $activity->id);
            }

            DB::commit();

            return redirect()
                ->route('admin.activity.edit', $activity->id)
                ->with('success', 'Kegiatan berhasil diperbarui.');

        } catch (\Exception $e) {
            DB::rollBack();

            return back()
                ->withInput()
                ->withErrors(['error' => 'Gagal memperbarui kegiatan: ' . $e->getMessage()]);
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
    public function deletePhoto($id)
    {
        try {
            $photo = PhotoActivity::findOrFail($id);

            // Image will be deleted automatically via model boot method
            $photo->delete();

            return response()->json([
                'success' => true,
                'message' => 'Foto berhasil dihapus.'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus foto: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Validate activity input.
     */
    private function validateActivity(Request $request, $activityId = null)
    {
        return $request->validate([
            'partner_id' => 'required|exists:partners,id',
            'title' => 'required|string|max:255',
            'short_description' => 'required|string|max:200',
            'full_description' => 'required|string',
            'activity_date' => 'required|date',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'photos.*' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048'
        ], [
            'partner_id.required' => 'Partner wajib dipilih.',
            'partner_id.exists' => 'Partner tidak valid.',
            'title.required' => 'Judul kegiatan wajib diisi.',
            'title.max' => 'Judul kegiatan maksimal 255 karakter.',
            'short_description.required' => 'Deskripsi singkat wajib diisi.',
            'short_description.max' => 'Deskripsi singkat maksimal 200 karakter.',
            'full_description.required' => 'Deskripsi lengkap wajib diisi.',
            'activity_date.required' => 'Tanggal kegiatan wajib diisi.',
            'activity_date.date' => 'Format tanggal tidak valid.',
            'featured_image.image' => 'File harus berupa gambar.',
            'featured_image.mimes' => 'Format gambar harus jpeg, png, jpg, atau webp.',
            'featured_image.max' => 'Ukuran gambar maksimal 2MB.',
            'photos.*.image' => 'Semua file harus berupa gambar.',
            'photos.*.mimes' => 'Format gambar harus jpeg, png, jpg, atau webp.',
            'photos.*.max' => 'Ukuran setiap gambar maksimal 2MB.',
        ]);
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
        $filename = time() . '_' . Str::random(10) . '.' . $file->getClientOriginalExtension();
        return $file->storeAs($folder, $filename, 'public');
    }

    /**
     * Upload multiple photos.
     */
    private function uploadPhotos($files, $activityId)
    {
        foreach ($files as $file) {
            $path = $this->uploadImage($file, 'partner_activity_photos');

            PhotoActivity::create([
                'activity_id' => $activityId,
                'image_path' => $path
            ]);
        }
    }
}