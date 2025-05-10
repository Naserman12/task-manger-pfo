<?php

namespace App\Livewire;
use App\Models\User;
use App\Notifications\GroupNotification;
use App\Notifications\GroupInvitationNotification;
use Livewire\Component;
use App\Models\Group;
use Illuminate\Support\Facades\Auth;
use App\Livewire\GroupMembers\emit;
use GuzzleHttp\Psr7\Request;

use function Symfony\Component\Clock\now;

class GroupMembers extends Component
{
    public  $groupId;
    public $group;
    public  $groupName;
    public $showInviteModel = false; //للتحكم في المودل
    public $availableUsers = [];
    public $notification;
    public $selectedRole = 'member';
    public $selectedUsers =[];
    public $search = '';
    

    public function mount( $groupId = null){
        $this->groupId = $groupId;
        $group = Group::find($groupId);
        $this->groupName = $group ? $group->name : 'لم يتم التعرف على اسم المجموعة';

        $this->loadAvailableUsers();
    }
    public function loadAvailableUsers(){
        $this->availableUsers = User::whereNotIn('id', $this->group->members->pluck('id'))
                    ->when($this->search, function($query){
                        $query->where('name', 'like', '%'.$this->search.'%');
                        })->limit(10)->get();
    }
    public function getAvailableUsersProperty(){
        return User::whereNotIn('id', $this->group->members->pluck('id'))
                ->when($this->search, fn($q) => $q->where('name', 'like', '%'.$this->search.'%'))
                ->limit(10)->get();
    }
    public function addMembers( ){
        if(empty($this->selectedUsers)){
            $this->dispatch('alert', ['message' => 'لم يتم تحديد اي عضو']);
        }
        $this->validate([
            'selectedUsers' => 'required|array',
            'selectedUsers.*' => 'exists:users,id',
            'selectedRole' =>  'required|in:member,sub_leader'
        ]);
         foreach ($this->selectedUsers as $userId) {
            $this->group->members()->attach( $userId ,[
                    'role' => $this->selectedRole,
                    'status' => 'pending',
                    'invited_by' => Auth::id(), 
                    'invited_at' => now()->format('Y-m-d'),                
                    'responded_at' => now()->format('Y-m-d'),                
                    'joined_at' => now()->format('Y-m-d')                       
            ]);
            $user = User::find($userId);
            $user->notify(new GroupNotification(
                $this->group, 
                Auth::user(),
                ''
            ));
        }
        session()->flash('message', 'تم اضافة الأعضاء');
        $this->selectedUsers = [];
        $this->loadAvailableUsers();
        $this->dispatch('membersUpdated');
    }
    // إرسال دعوة ال الاعضاء للإنضمام الى المجموعة

    public function inviteMembers(){
        $this->validate([
            'selectedUsers' => 'required|array',
            'selectedRole' =>  'required|in:member,sub_leader',
            'selectedUsers.*' => 'exists:users,id'
        ]);
        foreach($this->selectedUsers as $userId){
            // إرسال الدعوة
            $user = User::find($userId);
            if ($user) {
                $user->notify(new GroupInvitationNotification(
                    $this->groupId,
                    $this->groupName,
                    $this->selectedRole
                ));
                  }
        }
        session()->flash('message', 'تم إرسال الدعوة بنجاح');
    }
    public function removeMember ($userId){
        try {
            $this->group->members()->detach($userId);
            $this->dispatch('memberUpdated');
            $user = User::find($userId);
            $user->notify(new GroupNotification(
                $this->group, 
                'member_removed', 
                Auth::user()
            ));
            session()->flash('message', ' تم حذف العضو من المجموعة بنجاح');   
        } catch (\Exception $e) {
            session('error',  'لم يتم الحذف'.$e->getMessage());
        }
    }
    public function render()
    {
        
        return view('livewire.group-members', [
            'currentMembers' => $this->group->members()
                ->withPivot(['role', 'status', 'invited_at'])->get()
        ]);
    }
}
