<?php

namespace App\Livewire\Projects;

use Livewire\Component;
use App\Models\Project;
use App\Models\Group;
use Illuminate\Support\Facades\Auth;

class Create extends Component
{
    public $name, $description, $start_date, $end_date, $group_id;
    public $status = 'pending';   
    public $priority = 'medium';
    public $groups;
     public $counter = 0;
    public function mount()
    {
        $this->groups = Group::all(); // لجلب المجموعات من قاعدة البيانات
    }

    public function store()
    {
         dd('تم الوصول إلى دالة store');
         logger('وصلنا لدالة store في Livewire');
          $this->validate([
        'name' => 'required|string|max:255',
        'description' => 'required',
        'start_date' => 'required|date',
        'end_date' => 'required|date|after_or_equal:start_date',
        'group_id' => 'required|exists:groups,id',
        'priority' => 'required|in:low,medium,high',
        'status' => 'required|in:pending,in_progress,completed,cancelled',
    ]);

    
    try {
            //code...
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
        session()->flash('success', 'تم إنشاء المشروع بنجاح!');
        return redirect()->route('admin.projects.index');
        } catch (\Exception $e) {
            session()->flash('error', 'Error'.$e->getMessage());
        }
    }
    public function render()
    {
        return view('livewire.admin.projects.create');
    }
}

