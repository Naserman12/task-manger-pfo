<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;

class ProjectController extends Controller
{
    public $project;
     public function index(){
        $project = Project::with('leader')->paginate(10);
        return view('livewire.admin.groups.admin-index',compact('project'));
     }
      public function create(){
       return  view('livewire.admin.project.create-project');
    }
    public function edit(Project $project){
        return view('livewire.admin.project.edit-project', compact('project'));
    }
     public function show($id)
    {
        $this->project = Project::with('group', 'tasks')->findOrFail($id);
        return view('livewire.admin.project.show-project', ['project' => $this->project]);
    }
    public function destroy(Project $project)
        {
            return view('livewire.admin.project.delete-project', $project);
        }

}
