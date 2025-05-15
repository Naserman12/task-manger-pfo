<?php

namespace App\Livewire\Project;

use Livewire\Component;
use App\Models\Project;

class IndexProjects extends Component
{
    public $projects;

    public function mount()
    {
        $this->projects = Project::with('group', 'creator')->latest()->get();
    }

    public function render()
    {
        return view('livewire.project.index-projects');
    }
}
