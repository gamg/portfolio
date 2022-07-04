<?php

namespace App\Http\Livewire\Project;

use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Project as ProjectModel;
use App\Http\Livewire\Traits\Slideover;
use App\Http\Livewire\Traits\ShowProjects;
use App\Http\Livewire\Traits\Notification;
use App\Http\Livewire\Traits\WithImageFile;

class Project extends Component
{
    use Slideover, WithImageFile, WithFileUploads, Notification, ShowProjects;

    public ProjectModel $currentProject;
    public $openModal = false;

    protected $listeners = ['deleteProject'];

    protected $rules = [
        'currentProject.name' => 'required|max:100',
        'currentProject.description' => 'required|max:450',
        'imageFile' => 'nullable|image|max:1024',
        'currentProject.video_link' => ['nullable', 'url', 'regex:/^(https|http):\/\/(www\.)?(youtube\.com\/watch\?v=|youtu\.be\/)[A-z0-9-]+/i'],
        'currentProject.url' => 'nullable|url',
    ];

    public function mount()
    {
        $this->fillProjects();
        $this->currentProject = new ProjectModel();
    }

    public function loadProject(ProjectModel $project, $modal = true)
    {
        if ($this->currentProject->isNot($project)) {
            $this->currentProject = $project;
            $this->reset('imageFile');
        }

        $this->openModal = $modal; // Always true to show project info

        if (!$modal){
            // It will be false when I want to edit any project
            $this->openSlide();
        }
    }

    public function create()
    {
        if ($this->currentProject->getKey()) {
            $this->currentProject = new ProjectModel();
        }

        $this->openSlide();
    }

    public function save()
    {
        $this->validate();

        if ($this->imageFile) {
            $this->deleteFile('google', $this->currentProject->image); // if there is an old image
            $this->currentProject->image = $this->imageFile->store('projects', 'google');
        }

        $this->currentProject->save();

        $this->mount();
        $this->reset(['imageFile', 'openSlideover']);
        $this->notify(__('Project saved successfully!'));
    }

    public function deleteProject(ProjectModel $project)
    {
        $this->deleteFile('google', $project->image);
        $project->delete();
        $this->fillProjects();
        $this->notify(__('Project has been deleted.'), 'deleteMessage');
    }

    public function render()
    {
        return view('livewire.project.project');
    }
}
