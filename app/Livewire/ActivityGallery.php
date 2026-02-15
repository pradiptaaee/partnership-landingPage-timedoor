<?php



namespace App\Livewire;


use Livewire\Component;
use App\Models\PartnerActivity;


class ActivityGallery extends Component
{
    public PartnerActivity $activity;
    public int $activeIndex = 0;
    public bool $open = false;


    public function mount(PartnerActivity $activity)
    {
        $this->activity = $activity->load('photos');
    }


    public function openLightbox(int $index)
    {
        $this->activeIndex = $index;
        $this->open = true;
    }


    public function closeLightbox()
    {
        $this->open = false;
    }


    public function next()
    {
        $this->activeIndex = ($this->activeIndex + 1) % $this->activity->photos->count();
    }


    public function prev()
    {
        $this->activeIndex = ($this->activeIndex - 1 + $this->activity->photos->count()) % $this->activity->photos->count();
    }


    public function render()
    {
        return view('livewire.activity-gallery');
    }
}