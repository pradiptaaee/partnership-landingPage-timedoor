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
    public function index(Request $request)
    {
        
        $query = PartnerActivity::with(['partner', 'photos']);

        if ($request->filled('partner_id')) {
            $query->where('partner_id', $request->partner_id);
        }

        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

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

        $activities = $query->paginate(6);

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
            $activity = PartnerActivity::create([
                'partner_id' => $validated['partner_id'],
                'title' => $validated['title'],
                'slug' => $this->generateUniqueSlug($validated['title']),
                'category_activity' => $validated['category_activity'],
                'full_description' => $validated['full_description'],
                'activity_date' => $validated['activity_date'],
                'featured_image' => $this->storeFeaturedImage($request),
            ]);

            $this->storeActivityDetail($activity, $validated);

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
                ->withErrors('errorMessage', 'Kegiatan gagal ditambahkan.');
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
        $validated = $this->validateActivity($request);

        DB::beginTransaction();

        try {
            $activity->update([
                'partner_id' => $validated['partner_id'],
                'title' => $validated['title'],
                'category_activity' => $validated['category_activity'],
                'slug' => $activity->isDirty('title')
                    ? $this->generateUniqueSlug($validated['title'], $id)
                    : $activity->slug,
                'full_description' => $validated['full_description'],
                'activity_date' => $validated['activity_date'],
                'featured_image' => $this->updateFeaturedImage($request, $activity),
            ]);

            $this->updateActivityDetail($activity, $validated, $request);

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
                ->with('errorMessage', 'Kegiatan gagal diperbarui.');
        }
    }


    /**
     * Remove the specified activity from storage.
     */
    public function destroy($id)
    {
        $activity = PartnerActivity::findOrFail($id);

        try {
            $activity->delete();

            return redirect()
                ->route('admin.activity.index')
                ->with('success', 'Kegiatan berhasil dihapus.');

        } catch (\Exception $e) {
            return back()
                ->withErrors('errorMessage', 'Kegiatan gagal diperbarui.'. $e->getMessage());
        }
    }

    /**
     * Delete individual photo from activity.
     */
    public function deletePhoto(PhotoActivity $photo)
    {
        try {
            
            $activityId = $photo->partner_activity_id;

            // Hapus file fisik dari storage
            $filePath = 'storage/activity/photos/' . $photo->image_path;
            Storage::disk('public')->delete($filePath);

           
            $photo->delete();

            return back()->with('success_alert', 'Foto berhasil dihapus dari galeri.');

        } catch (\Exception $e) {
            
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
                'speaker_photo' => $request->isMethod('post')
                    ? 'required|image|max:2028'
                    : 'nullable|image|max:2028',
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
        Request $request): void {
        if ($activity->category_activity !== $data['category_activity']) {
            $activity->seminarDetail()?->delete();
            $activity->workshopDetail()?->delete();
        }
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

        return $filename; 
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

        return $filename; 
    }
    private function storeSpeakerPhoto(Request $request): ?string
    {
        if (!$request->hasFile('speaker_photo')) {
            return null;
        }

        $file = $request->file('speaker_photo');
        $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

        $file->storeAs('activity/speakers', $filename, 'public');

        return $filename; 
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
                'image_path' => $filename, 
            ]);
        }
    }

}