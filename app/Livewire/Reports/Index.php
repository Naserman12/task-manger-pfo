<?php

namespace App\Livewire\Reports;

use Livewire\Component;
use App\Models\User;
use App\Models\Group;
use App\Models\Task;
use App\Models\Project;

use function Livewire\Volt\protect;

class Index extends Component
{
   public $usersCount;
    public $groupsCount;
    public $tasksCount, $projectCount;

    public function mount()
    {
        $this->usersCount = User::count();
        $this->groupsCount = Group::count();
        $this->tasksCount = Task::count();
        $this->projectCount = Project::count();
    }

    public function render()
    {
        return view('livewire.admin.reports.index');
    }
}
