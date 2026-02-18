<?php

namespace App\Livewire\Admin;

use App\Models\FreeTrial;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class FreeTrialIndex extends Component
{
    use WithPagination;

    // State untuk manajemen modal konfirmasi hapus
    public $confirmingTrialDeletion = false; 
    public $selectedTrialId;
    
    // State untuk filter, sorting, dan pagination
    public $search = '';
    public $sortBy = 'latest';
    public $perPage = 10;

    /**
     * Reset pagination ke halaman pertama saat melakukan pencarian.
     */
    public function updatingSearch()
    {
        $this->resetPage();
    }

    /**
     * Menampilkan modal konfirmasi penghapusan data.
     */
    public function confirmTrialDeletion($id)
    {
        $this->selectedTrialId = $id;
        $this->confirmingTrialDeletion = true;
    }

    /**
     * Menghapus data dari database lokal dan menyinkronkan dengan Google Sheets.
     */
    public function deleteTrial()
    {
        if ($this->selectedTrialId) {
            $data = FreeTrial::findOrFail($this->selectedTrialId);
            
            $googleSheetUrl = "https://script.google.com/macros/s/AKfycbxMsES88FIn7xA9obdzEZvQ8Kpc5hlrp0buwp48A87qwuPoQBapjVql0J2Wng46z5vJHg/exec";

            try {
                // Mengirim permintaan hapus ke API Google Apps Script
                Http::asForm()
                    ->withOptions([
                        'allow_redirects' => true,
                        'follow_redirects' => true,
                    ])
                    ->timeout(20)
                    ->post($googleSheetUrl, [
                        'action' => 'DELETE',
                        'id'     => (string)$this->selectedTrialId,
                    ]);
            } catch (\Exception $e) {
                // Log error jika integrasi eksternal gagal
                Log::error("Gagal sinkronisasi hapus Google Sheets: " . $e->getMessage());
            }

            // Hapus record dari database lokal
            $data->delete();
            
            $this->confirmingTrialDeletion = false;
            $this->selectedTrialId = null;

            // session()->flash('success', 'Data berhasil dihapus.');

            $this->dispatch('success-alert', message: 'Data pendaftaran berhasil dihapus!');
        }
    }

    /**
     * Render komponen Livewire dengan filter dan pencarian.
     */
    public function render()
    {
        // Otomatis tandai data sebagai 'sudah dibaca' saat index dibuka
        FreeTrial::where('is_read', false)->update(['is_read' => true]);

        // Mengirimkan event untuk memperbarui badge notifikasi di sidebar
        $this->dispatch('trial-read'); 

        // Query data pendaftaran dengan filter pencarian dan sorting
        $trials = FreeTrial::query()
            ->where(function($query) {
                $query->where('name', 'like', '%' . $this->search . '%')
                      ->orWhere('email', 'like', '%' . $this->search . '%')
                      ->orWhere('phone', 'like', '%' . $this->search . '%');
            })
            ->when($this->sortBy === 'latest', function($q) {
                return $q->latest();
            })
            ->when($this->sortBy === 'oldest', function($q) {
                return $q->oldest();
            })
            ->paginate($this->perPage);

        return view('livewire.admin.free-trial-index', [
            'trials' => $trials,
            'totalCountries' => FreeTrial::distinct('country')->count(),
            'newLeadsToday'  => FreeTrial::whereDate('created_at', today())->count(),
        ]);
    }
}