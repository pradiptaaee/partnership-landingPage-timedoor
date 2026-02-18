<?php

namespace App\Livewire\Admin;

use App\Models\Testimonial; // Pastikan nama model benar
use Livewire\Component;
use Livewire\WithPagination;

class TestimonialIndex extends Component
{
    use WithPagination;

    public $search = '';
    public $sort = 'latest';

    protected $queryString = ['search', 'sort'];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $testimonials = Testimonial::query()
            ->when($this->search, function ($query) {
                $query->where('parent_name', 'like', '%' . $this->search . '%')
                    ->orWhere('review', 'like', '%' . $this->search . '%')
                    ->orWhere('student_name', 'like', '%' . $this->search . '%');
            })
            ->when($this->sort, function ($query) {
                switch ($this->sort) {
                    case 'oldest':
                        $query->orderBy('created_at', 'asc');
                        break;
                    case 'az':
                        $query->orderBy('parent_name', 'asc');
                        break;
                    case 'za':
                        $query->orderBy('parent_name', 'desc');
                        break;
                    default:
                        $query->orderBy('created_at', 'desc');
                        break;
                }
            })
            ->paginate(6);

        return view('livewire.admin.testimonial-index', [
            'testimonials' => $testimonials
        ]);
    }
}