<?php

namespace App\Http\Livewire\Hero;

use App\Http\Livewire\Traits\Notification;
use App\Http\Livewire\Traits\Slideover;
use App\Http\Livewire\Traits\WithImageFile;
use App\Models\PersonalInformation;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class Info extends Component
{
    use Slideover, Notification, WithFileUploads, WithImageFile;

    public PersonalInformation $info;
    public $cvFile = null;

    protected $rules = [
        'info.title' => 'required|max:40',
        'info.description' => 'required|max:140',
        'cvFile' => 'nullable|mimes:pdf|max:1024',
        'imageFile' => 'nullable|image|max:1024',
    ];

    /*public function updatedCvFile()
    {
        $this->validate([
            'cvFile' => 'mimes:pdf|max:1024',
        ]);
    }*/

    public function mount()
    {
        $this->info = PersonalInformation::first() ?? new PersonalInformation();
    }

    public function download()
    {
        return Storage::disk('google')->download($this->info->cv ?? 'cv/my-cv.pdf');
    }

    public function edit()
    {
        $this->validate();

        $this->info->save();

        if ($this->cvFile) {
            $this->deleteFile('google', $this->info->cv);
            $this->info->update(['cv' => $this->cvFile->store('cv', 'google')]);
        }

        if ($this->imageFile) {
            $this->deleteFile('google', $this->info->image);
            $this->info->update(['image' => $this->imageFile->store('hero', 'google')]);
            $this->emitTo('hero.image','heroImageUpdated');
        }

        $this->resetExcept('info');
        $this->notify(__('Information saved successfully!'));
    }

    public function render()
    {
        return view('livewire.hero.info');
    }
}
