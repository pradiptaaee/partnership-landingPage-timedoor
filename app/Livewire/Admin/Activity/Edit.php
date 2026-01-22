<?php

namespace App\Livewire\Admin\Activity;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\PartnerActivity;
use App\Models\PhotoActivity;
use App\Models\Partner;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class Edit extends Component
{
    use WithFileUploads;

    public PartnerActivity $activity;

    // form state
    public $partner_id;
    public $title;
    public $short_description;
    public $full_description;
    public $activity_date;

    // media
    public $featured_image;
    public $new_photos = [];

    protected $rules = [
        'partner_id' => 'required|exists:partners,id',
        'title' => 'required|max:255',
        'short_description' => 'required|max:200',
        'full_description' => 'required',
        'activity_date' => 'required|date',

        'featured_image' => 'nullable|image|max:2048',
        'new_photos.*' => 'image|mimes:jpg,jpeg,png|max:2048',
    ];

    public function mount(PartnerActivity $activity)
    {
        $this->activity = $activity;

        // hydrate state
        $this->partner_id = $activity->partner_id;
        $this->title = $activity->title;
        $this->short_description = $activity->short_description;
        $this->full_description = $activity->full_description;
        $this->activity_date = $activity->activity_date->format('Y-m-d');
    }

    public function update()
    {
        $this->validate();

        DB::beginTransaction();
        try {
            $this->activity->update([
                'partner_id' => $this->partner_id,
                'title' => $this->title,
                'short_description' => $this->short_description,
                'full_description' => $this->full_description,
                'activity_date' => $this->activity_date,
            ]);

            // upload featured image jika ada
            if ($this->featured_image) {
                $fileName = time() . '_' . uniqid() . '.' . $this->featured_image->getClientOriginalExtension();
                $this->featured_image->storeAs('public/activity/featured', $fileName);

                $this->activity->update([
                    'featured_image' => $fileName
                ]);
            }

            // upload foto baru
            if ($this->new_photos) {
                foreach ($this->new_photos as $photo) {
                    $name = time() . '_' . uniqid() . '.' . $photo->getClientOriginalExtension();
                    $photo->storeAs('public/activity/photos', $name);

                    PhotoActivity::create([
                        'activity_id' => $this->activity->id,
                        'image_path' => $name
                    ]);
                }
            }

            DB::commit();

            // 🔴 INI BAGIAN KUNCI
            session()->flash('success_message', 'Kegiatan berhasil diperbarui.');

            return redirect()->route('admin.activity.index');

        } catch (\Exception $e) {
            DB::rollBack();

            session()->flash('error_message', 'Gagal memperbarui data.');
        }
    }

    // 🔥 DELETE FOTO PER ITEM
    public function deletePhoto($photoId)
    {
        $photo = PhotoActivity::findOrFail($photoId);

        Storage::disk('public')
            ->delete('activity/photos/' . $photo->image_path);

        $photo->delete();

        $this->activity->refresh();
    }

    public function render()
    {
        return view('livewire.admin.activity.edit', [
            'partners' => Partner::orderBy('name')->get()
        ]);
    }
}