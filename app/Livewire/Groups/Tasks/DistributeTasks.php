<?php
namespace App\Livewire\Groups\Tasks;

use App\Models\Group;
use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class DistributeTasks extends Component
{
    public Group $group;
    public Project $project;

    public string $title = '';
    public string $description = '';
    public $assignedTo = null;
    public $dueAt = null;

    public function mount(Group $group, Project $project)
    {
        $this->group = $group;
        $this->project = $project;
    }

    public function createTask()
    {
        $this->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'assignedTo' => 'nullable|exists:users,id',
            'dueAt' => 'nullable|date',
        ]);

        Task::create([
            'title' => $this->title,
            'description' => $this->description,
            'assigned_to' => $this->assignedTo,
            'due_at' => $this->dueAt,
            'group_id' => $this->group->id,
            'project_id' => $this->project->id,
            'created_by' => Auth::id(),
            'status' => $this->assignedTo ? 'pending' : 'available',
        ]);

        $this->reset(['title', 'description', 'assignedTo', 'dueAt']);
        session()->flash('success', 'تم إنشاء المهمة بنجاح.');
    }

    public function render()
    {
        $members = $this->group->members()->get(); // تأكد أن لديك علاقة members() في المودل
        $tasks = Task::where('project_id', $this->project->id)->get();

        return view('livewire.groups.tasks.distribute-tasks', compact('members', 'tasks'));
    }
}
