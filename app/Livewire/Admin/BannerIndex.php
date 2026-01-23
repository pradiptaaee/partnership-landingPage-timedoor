<?php
namespace App\Livewire\Admin;

use App\Models\Banner;
use Livewire\Component;
use Livewire\WithPagination;

class BannerIndex extends Component
{
    use WithPagination;

    public $search = '';
    public $sort = 'latest';

    // Reset halaman ke 1 setiap kali user mengetik di search
    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $banners = Banner::query()
            ->when($this->search, function ($query) {
                // Asumsi kolom title disimpan dalam JSON oleh Spatie Translatable
                $query->where('title->en', 'like', '%' . $this->search . '%')
                    ->orWhere('title->id', 'like', '%' . $this->search . '%');
            })
            ->when($this->sort, function ($query) {
                $query->orderBy('created_at', $this->sort === 'latest' ? 'desc' : 'asc');
            })
            ->paginate(6);

        return view('livewire.admin.banner-index', [
            'banners' => $banners
        ]);
    }
}