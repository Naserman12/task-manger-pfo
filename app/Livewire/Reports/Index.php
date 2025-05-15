<?php

namespace App\Livewire\Reports;

use Livewire\Component;
use App\Models\User;
use App\Models\Group;
use App\Models\Task;
class Index extends Component
{
   public $usersCount;
    public $groupsCount;
    public $tasksCount;

    public function mount()
    {
        $this->usersCount = User::count();
        $this->groupsCount = Group::count();
        $this->tasksCount = Task::count();
    }

    public function render()
    {
        return view('livewire.admin.reports.index');
    }
}
