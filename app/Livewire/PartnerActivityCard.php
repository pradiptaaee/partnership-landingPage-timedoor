<?php

namespace App\Livewire;

use App\Models\Partner;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\PartnerActivity; // Sesuaikan dengan model kamu

class PartnerActivityCard extends Component
{
    use WithPagination;

    public $search = '';
    public $category = '';
    public $year = '';

    protected $paginationTheme = 'bootstrap'; // Untuk Bootstrap styling

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function updatedCategory()
    {
        $this->resetPage();
    }

    public function updatedYear()
    {
        $this->resetPage();
    }

    public function resetFilters()
    {
        $this->search = '';
        $this->category = '';
        $this->year = '';
        $this->resetPage();
    }
    

    public function render()
    {
        $activities = PartnerActivity::query()
            ->when($this->search, function ($query) {
                $query->where('title', 'like', '%' . $this->search . '%')
                    ->orWhere('short_description', 'like', '%' . $this->search . '%');
            })
            ->when($this->category, function ($query) {
                $query->where('category', $this->category);
            })
            ->when($this->year, function ($query) {
                $query->whereYear('activity_date', $this->year);
            })
            ->latest('activity_date')
            ->paginate(6); // 9 items per page (3 kolom x 3 baris)

        return view('livewire.partner-activity-card', [
            'activities' => $activities
        ]);
    }
}
