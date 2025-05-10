<?php

namespace App\Livewire;

use Livewire\Component;

class GroupTasks extends Component
{
    public $group;
    public function mount($group) {
        $this->group = $group;
    }
    public function render()
    {
        return view('livewire.group-tasks', [
            'tasks' => $this->group->tasks()->latest()->get(),
        ]);
    }
}
