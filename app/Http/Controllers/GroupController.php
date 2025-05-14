<?php

namespace App\Http\Controllers;
use App\Models\Group;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    function index(){
        $groups = Group::with('leader')->paginate(10);
        return view('livewire/groups.index',compact('groups'));
    }
    public function show($id){
        $group  = Group::with(['leader', 'members'])->findOrFail($id);
        return view('livewire.groups.show', compact('group'));
    }
    public function create(){
       return  view('livewire.groups.create');
    }
    public function edit(Group $group){
        return view('livewire.groups.edit', compact('group'));
    }
   public function destroy(Group $group){
        try {
            $group->delete();
            return redirect()->route('groups.index')
                ->with('seccess', 'تم حذف المجموعة بنجاح.');
        } catch (\Exception $e) {
           return redirect()->back()->with('error', 'حدث خطأ ولم يتم الحذف' .$e->getMessage());
        }
    }
}
