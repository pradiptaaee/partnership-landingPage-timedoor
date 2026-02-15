<?php

namespace App\Livewire\Admin;

use App\Models\StudentProject; // Pastikan nama model sesuai
use Livewire\Component;
use Livewire\WithPagination;

class ProjectIndex extends Component
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
        $projects = StudentProject::query()
            ->when($this->search, function ($query) {
                $query->where('student_name', 'like', '%' . $this->search . '%')
                    ->orWhere('project_type->en', 'like', '%' . $this->search . '%')
                    ->orWhere('project_type->id', 'like', '%' . $this->search . '%');
            })
            ->when($this->sort, function ($query) {
                switch ($this->sort) {
                    case 'oldest':
                        $query->orderBy('created_at', 'asc');
                        break;
                    case 'az':
                        $query->orderBy('student_name', 'asc');
                        break;
                    case 'za':
                        $query->orderBy('student_name', 'desc');
                        break;
                    default:
                        $query->orderBy('created_at', 'desc');
                        break;
                }
            })
            ->paginate(6);

        return view('livewire.admin.project-index', [
            'projects' => $projects
        ]);
    }
}