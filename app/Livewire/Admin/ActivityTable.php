<?php

namespace App\Livewire\Admin;

use App\Models\Partner;
use App\Models\PartnerActivity;
use Livewire\Component;
use Livewire\WithPagination;

class ActivityTable extends Component
{
    use WithPagination;

    // --- Properti Livewire ---
    public $search = '';
    public $partnerFilter = 'all'; // Untuk filter berdasarkan partner_id
    public $sortBy = 'latest';
    public $perPage = 6; // Sesuai dengan setting pagination di Controller lama Anda

    public $confirmingActivityDeletion = false;
    public $activityIdToDelete = null;

    
    // Method ini akan dijalankan saat properti di atas berubah
    public function updated($propertyName)
    {
        // Reset halaman paginasi saat filter atau search berubah
        $this->resetPage();
    }

    
    public function paginationView()
    {
        return 'livewire::tailwind';
    }

    public function resetFilters()
    {
        // Set semua properti filtering ke nilai default mereka
        $this->search = '';
        $this->partnerFilter = 'all';
        $this->sortBy = 'latest';

        // Sangat penting: Mereset halaman paginasi kembali ke halaman 1
        $this->resetPage();
    }
    public function confirmActivityDeletion($activitiesId)
    {
        $this->confirmingActivityDeletion = true;
        $this->activityIdToDelete = $activitiesId;
    }

    public function deleteActivity()
    {
        $activity = PartnerActivity::find($this->activityIdToDelete);

        if ($activity) {
            $activity->delete();

            // 1. Ganti session()->flash() dengan Event Dispatch
            $this->dispatch('success-alert', message: 'Kegiatan berhasil dihapus dari sistem.');

            // Reset state modal dan data
            $this->confirmingActivityDeletion = false;
            $this->activityIdToDelete = null;

        } else {
            // Jika gagal, bisa dispatch error event juga jika diinginkan
            // $this->dispatch('error-alert', message: 'Gagal menghapus partner.');

            // Reset state modal
            $this->confirmingActivityDeletion = false;
            $this->activityIdToDelete = null;
        }

        $this->resetPage();
    }
    public function render()
    {
        $query = PartnerActivity::with(['partner', 'photos']);

        // 1. Search by title
        if ($this->search) {
            $query->where('title', 'like', '%' . $this->search . '%');
        }

        // 2. Filter by Partner
        if ($this->partnerFilter !== 'all') {
            $query->where('partner_id', $this->partnerFilter);
        }

        // 3. Sorting
        switch ($this->sortBy) {
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

        $activities = $query->paginate($this->perPage);

        // Ambil semua partner untuk filter dropdown
        $partners = Partner::orderBy('name', 'asc')->get();

        return view('livewire.admin.activity-table', [
            'activities' => $activities,
            'partners' => $partners, // Kirim daftar partner ke view
        ]);
    }
}