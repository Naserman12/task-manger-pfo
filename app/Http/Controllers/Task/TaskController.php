<?php

namespace App\Http\Controllers\Task;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\Group;
use App\Models\Project;
class TaskController extends Controller
{
         public function index(){
        $tasks = Task::with('assignedUser')->paginate(10);
        return view('livewire.groups.tasks.index-tasks',compact('tasks'));
     }
     public function show($id)
        {
            $task = Task::with('assignedUser', 'comments.user')->findOrFail($id);
            return view('livewire.groups.tasks.showTaskDetails', compact('task'));
        }
      public function create(Group $group, Project $project){
       return  view('livewire.groups.tasks.create-tasks', compact('group', 'project'));
    }
}
