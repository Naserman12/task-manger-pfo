<?php

namespace App\Livewire\Groups\Tasks;


use Livewire\Component;
use App\Models\Task;

class TasksList extends Component
{
  
    public $search = '';
    public $statusFilter = '';

    public function render()
    {
        $tasks = Task::query()
            ->when($this->search, function($query) {
                $query->where('title', 'like', '%' . $this->search . '%')
                      ->orWhereHas('assignedUser', function ($subQuery) {
              $subQuery->where('name', 'like', '%' . $this->search . '%');
            });
            })
            ->when($this->statusFilter, function($query) {
                $query->where('status',$this->statusFilter);
            })
            ->orderBy('due_at')
            ->get();

        return view('livewire.groups.tasks.tasks-list', [
            'tasks' => $tasks,
        ]);
    }
}
