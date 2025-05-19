<?php

namespace App\Http\Controllers\Task;

use App\Http\Controllers\Controller;
use Illuminate\Database\QueryException;
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
     public function show($id) {
            $task = Task::with('assignedUser', 'comments.user')->findOrFail($id);
            return view('livewire.groups.tasks.ShowTaskDetails', compact('task'));
        }
        public function create(Group $group, Project $project){
            return  view('livewire.groups.tasks.create-tasks', compact('group', 'project'));
        }
        public function edit($id){
               $task = Task::findOrFail($id);
               return view('livewire.groups.tasks.edit-task', compact('task'));
           }
           public function destroy($id){
                $task = Task::findOrFail($id);
                       try {
                            $task->delete();
                            return redirect()->route('tasks.index-tasks')->with('message', 'تم حذف المهمة بنجاح');
                        } catch (QueryException $e) {
                            // تحقق أن الخطأ ناتج عن مفتاح أجنبي
                            if ($e->getCode() == '23000') {
                                return redirect()->route('tasks.index-tasks')->with('error', 'لا يمكن حذف هذه المهمة لأنها مرتبطة بتعليقات.');
                            }
                            // أخطاء أخرى غير متوقعة
                            return redirect()->route('tasks.index-tasks')->with('error', 'حدث خطأ أثناء حذف المهمة.');
                        }
            }

        public function update(Request $request, $id)
           {
               $task = Task::findOrFail($id);
               $task->update($request->all());
               return redirect()->route('tasks.index-tasks')->with('message', 'تم التحديث بنجاح.');
           }
}
