<?php

namespace App\Livewire\Admin;

use App\Models\Partner;
use App\Models\PartnerActivity;
use Livewire\Component;
use Livewire\WithPagination;

class PartnerTable extends Component
{
    use WithPagination;

    // --- PROPERTI UNTUK FILTER, SORT, PAGINASI ---
    public $search = '';
    public $sortBy = 'latest';
    public $perPage = 10; // Nilai default: 10 data per halaman

    // --- PROPERTI UNTUK PENGHAPUSAN ---
    public $confirmingPartnerDeletion = false;
    public $partnerIdToDelete = null;

    // --- PROPERTI STATISTIK ---
    public $totalPartners;
    public $totalCategories;
    public $totalActivities;
    public $uniqueCategories;

    // Menambahkan perPage ke Query String agar URL tetap sinkron
    protected $queryString = [
        'search' => ['except' => ''],
        'sortBy' => ['except' => 'latest'], 
        'perPage' => ['except' => 10],// Tambahkan perPage
    ];

    public function mount()
    {
        // ... (Logika mount tetap sama) ...
        $this->totalPartners = Partner::count();
        $this->totalCategories = Partner::distinct('category')->count('category');
        $this->totalActivities = PartnerActivity::count();
        $this->uniqueCategories = Partner::select('category')->distinct()->pluck('category');
    }

    // Reset halaman paginasi setiap kali properti filter/search/limit diubah
    public function updatingSearch()
    {
        $this->resetPage();
    }
    
    public function updatingPerPage()
    {
        $this->resetPage();
    } // Reset saat batas paginasi diubah

    public function paginationView()
    {
        return 'livewire::tailwind';
    }

    public function resetFilters()
    {
        // Set semua properti filtering ke nilai default mereka
        $this->search = '';
        $this->sortBy = 'latest';

        // Sangat penting: Mereset halaman paginasi kembali ke halaman 1
        $this->resetPage();
    }

    // Method untuk menampilkan modal konfirmasi hapus
    public function confirmPartnerDeletion($partnerId)
    {
        $this->confirmingPartnerDeletion = true;
        $this->partnerIdToDelete = $partnerId;
    }

    // Method untuk melakukan penghapusan
    // app/Livewire/Admin/PartnerTable.php (Hanya bagian deletePartner yang diubah)

    public function deletePartner()
    {
        $partner = Partner::find($this->partnerIdToDelete);

        if ($partner) {
            $partner->delete();

            // 1. Ganti session()->flash() dengan Event Dispatch
            $this->dispatch('success-alert', message: 'Partner berhasil dihapus dari sistem.');

            // Reset state modal dan data
            $this->confirmingPartnerDeletion = false;
            $this->partnerIdToDelete = null;

            // Perbarui statistik dan render ulang
            $this->mount();
        } else {
            // Jika gagal, bisa dispatch error event juga jika diinginkan
            // $this->dispatch('error-alert', message: 'Gagal menghapus partner.');

            // Reset state modal
            $this->confirmingPartnerDeletion = false;
            $this->partnerIdToDelete = null;
        }

        $this->resetPage();
    }

    // Method Render (Logika Query)
    public function render()
    {
        $query = Partner::query();

        // 1. Terapkan Search
        if ($this->search) {
            $query->where('name', 'like', '%' . $this->search . '%');
        }

        switch ($this->sortBy) {
            case 'oldest':
                $query->orderBy('created_at', 'asc');
                break;
            case 'name_asc':
                $query->orderBy('name', 'asc');
                break;
            case 'name_desc':
                $query->orderBy('name', 'desc');
                break;
            case 'latest':
            default:
                $query->orderBy('created_at', 'desc'); // Default: Terbaru
                break;
        }

        return view('livewire.admin.partner-table', [
            // 4. Lakukan Paginasi menggunakan $this->perPage
            'partners' => $query->paginate($this->perPage),
        ]);
    }
}