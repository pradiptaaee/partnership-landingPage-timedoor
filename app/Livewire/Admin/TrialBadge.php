<?php

namespace App\Livewire\Admin;

use App\Models\FreeTrial;
use Livewire\Component;

class TrialBadge extends Component
{
    public $type = 'main';
   public function render()
    {
        $count = \App\Models\FreeTrial::where('is_read', false)->count();

        return view('livewire.admin.trial-badge', compact('count'));
    }
}