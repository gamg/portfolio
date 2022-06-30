<?php

namespace App\Http\Livewire\Hero;

use App\Models\PersonalInformation;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class Image extends Component
{
    private PersonalInformation $info;

    protected $listeners = ['heroImageUpdated' => 'mount'];

    public function mount()
    {
        $this->info = PersonalInformation::first() ?? new PersonalInformation();
    }

    public function getImageUrlProperty()
    {
        $image = $this->info->only('image')['image'] ?? 'hero/default-hero.jpg';
        return Storage::disk('google')->url($image);
    }

    public function render()
    {
        return view('livewire.hero.image');
    }
}
