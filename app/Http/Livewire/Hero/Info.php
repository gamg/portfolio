<?php

namespace App\Http\Livewire\Hero;

use App\Http\Livewire\Traits\Notification;
use App\Http\Livewire\Traits\Slideover;
use App\Models\PersonalInformation;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use RuntimeException;

class Info extends Component
{
    use WithFileUploads;
    use Slideover;
    use Notification;

    public PersonalInformation $info;
    public $cvFile = null;
    public $cvUrl = '';
    public $imageFile = null;
    public $imageUrl = '';

    protected $rules = [
        'info.title' => 'required|max:40',
        'info.description' => 'required|max:140',
        'cvFile' => 'nullable|mimes:pdf|max:1024',
        'imageFile' => 'nullable|image|max:1024',
    ];

    public function updatedCvFile()
    {
        $this->validate([
            'cvFile' => 'mimes:pdf|max:1024',
        ]);
    }

    public function updatedImageFile()
    {
        $this->verifyTemporaryUrl();

        $this->validate([
            'imageFile' => 'image|max:1024',
        ]);
    }

    public function mount()
    {
        $this->info = PersonalInformation::first() ?? new PersonalInformation();
        $this->generateFilesUrls();
    }

    public function download()
    {
        return Storage::disk('cv')->download($this->info->cv ?? 'my-cv.pdf');
    }

    private function generateFilesUrls()
    {
        $cv = $this->info->cv ?? 'my-cv.pdf';
        $image = $this->info->image ?? 'default-hero.jpg';
        $this->cvUrl = Storage::disk('cv')->url($cv);
        $this->imageUrl = Storage::disk('hero')->url($image);
    }

    private function verifyTemporaryUrl()
    {
        try {
            $this->imageFile->temporaryUrl();
        }catch (RuntimeException $exception){
            $this->reset('imageFile');
        }
        // Another way to solve the problem
        /*if (!in_array($this->imageFile->extension(), ['png', 'jpeg', 'bmp', 'gif', 'jpg'])) {
            $this->reset('imageFile');
        }*/
    }

    private function deleteOldFile($disk, $filename)
    {
        if ($filename && Storage::disk($disk)->exists($filename)) {
            Storage::disk($disk)->delete($filename);
        }
    }

    public function edit()
    {
        $this->validate();

        $this->info->save();

        if ($this->cvFile) {
            $this->deleteOldFile('cv', $this->info->cv);
            $this->info->update(['cv' => $this->cvFile->store('/', 'cv')]);
        }

        if ($this->imageFile) {
            $this->deleteOldFile('hero', $this->info->image);
            $this->info->update(['image' => $this->imageFile->store('/', 'hero')]);
            $this->emitTo('hero.image','heroImageUpdated');
        }

        $this->resetExcept('info');
        $this->generateFilesUrls();
        $this->notify('Information saved successfully!');
    }

    public function render()
    {
        return view('livewire.hero.info');
    }
}
