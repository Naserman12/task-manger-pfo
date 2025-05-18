<?php

namespace App\Livewire\Admin\Project;

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
        return view('livewire.admin.project.index-projects');
    }
}
