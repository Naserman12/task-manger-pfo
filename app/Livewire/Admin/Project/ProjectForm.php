<?php

namespace App\Livewire\Admin\Project;

use Livewire\Component;
use App\Models\Project;
use App\Models\Group;
use Illuminate\Support\Facades\Auth;

class ProjectForm extends Component
{
    public $project;
    public $name;
    public $isEdit = false, $project_id;

    public $description;
    public $start_date;
    public $end_date;
    public $status = 'pending';
    public $created_by;
    public $priority = 'low';
    public $group_id;

    public $groups;

    public function mount($id = null )
    {
        $this->groups = Group::all();
        // $this->project = Project::all();
            if ($id) {
            $this->isEdit = true;
            $this->project_id = $id;
            $this->project = Project::findOrFail($id); //✅
            $this->name = $this->project->name;
            $this->description = $this->project->description;
            $this->start_date = $this->project->start_date;
            $this->end_date = $this->project->end_date;
            $this->status = $this->project->status;
            $this->priority = $this->project->priority;
            $this->group_id = $this->project->group_id;
        } else {
            $this->isEdit = false;
            $this->project = new Project(); // أو تهيئة فارغة
        }
    }

    public function save()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'status' => 'required|in:pending,in_progress,completed,cancelled',
            'priority' => 'required|in:low,medium,high',
            'group_id' => 'required|exists:groups,id'
        ]);
        $data = $this->only([
            'name', 'description', 'start_date', 'end_date', 'status', 'priority', 'group_id',
        ]);

        if ($this->isEdit) {
            $project = Project::findOrFail($this->project_id);
            $project->update($data);
            session()->flash('success', 'تم تحديث المشروع بنجاح');
            $this->resetForm();
        } else {
            // Project::create($data);
                 Project::create([
                'name' => $this->name,
                'description' => $this->description,
                'start_date' => $this->start_date,
                'end_date' => $this->end_date,
                'group_id' => $this->group_id,
                'created_by' => Auth::id(),
                'status' => $this->status,
                'priority' => $this->priority,
            ]);
            $this->resetForm();
            session()->flash('success', 'تم إنشاء المشروع بنجاح');
            $this->resetExcept('groups');
        }
    }
    function resetForm(){
        $this->reset(['name', 'description', 'start_date', 'end_date', 'status', 'priority', 'group_id']);
        $this->isEdit = false;
        $this->project_id = null;
        return redirect()->to('/admin/projects');
    }
    public function render()
    {
        return view('livewire.admin.project.project-form');
    }
}

