<?php

namespace App\Http\Livewire\Traits;

use App\Models\Project as ProjectModel;

trait ShowProjects
{
    public $count = 3;
    public $projects;

    public function getTotalProperty()
    {
        return ProjectModel::count();
    }

    public function showMore()
    {
        if ($this->count < $this->total) {
            $this->count += 3;
        }

        $this->fillProjects();
    }

    public function showLess()
    {
        $this->count = 3;
        $this->fillProjects();
    }

    public function fillProjects()
    {
        $this->projects = ProjectModel::take($this->count)->get();
    }
}
