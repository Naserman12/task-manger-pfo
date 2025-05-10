<?php

namespace App\Livewire\Groups;

use App\Notifications\GroupNotification;
use Livewire\Component;
use App\Models\User;
use App\Models\Group;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
class GroupForm extends Component
{
    public $group_id = null, $groups, $name, $leader_id, $isEdit = false, $users;
   
    public function mount($groupId = null){
        $this->users = User::all();
        $this->groups = Group::all();
         if ($groupId) {
            $this->isEdit = true;
            $this->group_id = $groupId;
            $this->loadGroupData();    
        }
    }
    protected $rules = [
            'name' => 'required|string|min:3',
            'leader_id' => 'required|integer'
        ];
    //  تحميل بيانات المجموعة 
     protected function  loadGroupData(){
        $group = Group::find($this->group_id);
        $this->name = $group->name;
        $this->leader_id = $group->leader_id;
     }
    function saveGroup(){
        $this->validate();
        try {
            Log::debug('Data befor  save: ',[
                'isEdit' => $this->isEdit,
                'Group_id' => $this->group_id,
                'name' => $this->name,
                'leader_id' => $this->leader_id
            ]);
            if ($this->isEdit) {
                $group = Group::findOrFail($this->group_id);
                $group->update([ 'name' => $this->name, 'leader_id' => $this->leader_id]);
               
                
                    $group->notify(  new GroupNotification(
                        $this->group, 
                        '', 
                        Auth::user()
                    ));
                session()->flash('message', 'تم تحديث المجموعة بنجاح');
            }else{
                
                Group::create(['name' => $this->name, 'leader_id' => $this->leader_id]);  
                session()->flash('message', ' تم إنشاء المجموعة بنجاح');
            }
            $this->resetForm();
            return redirect()->to('/'); 
        } catch (\Exception $e) {
        Log::error('Save Error: '. $e->getMessage());
        session('error', 'حجث خطأ'.$e->getMessage());
        }
        $this->reset(['name', 'leader_id']);
        $this->groups = Group::all();
    }
    public function resetForm(){
        $this->reset(['name', 'leader_id']);
        $this->isEdit = false;
        $this->group_id = null;
    }

    public function render()
    {
        return view('livewire.groups.group-form');
    }
}