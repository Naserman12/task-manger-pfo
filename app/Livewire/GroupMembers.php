<?php

namespace App\Livewire;
use App\Models\User;
use App\Notifications\GroupNotification;
use App\Notifications\GroupInvitationNotification;
use Livewire\Component;
use App\Models\Group;
use Illuminate\Support\Facades\Auth;
use App\Livewire\GroupMembers\emit;
use App\Notifications\MemberRemovedNotification;
use GuzzleHttp\Psr7\Request;

use function Symfony\Component\Clock\now;

class GroupMembers extends Component
{
    public  $groupId;
    public $group;
    public  $groupName;
    public $confirmingDelete = false;
    public $memberToDeleteId = null;
    public $showInviteModel = false; //للتحكم في المودل
    public $availableUsers = [];
    public $notification;
    public $selectedRole = 'member';
    public $selectedUsers =[];
    public $search = '';
    

    public function mount( $groupId){
        $this->groupId = $groupId;
        $this->group = Group::find($groupId);
        $this->groupName = $this->group ? $this->group->name : 'لم يتم التعرف على اسم المجموعة';

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
                $this->eventType
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
            'selectedUsers.*' => 'exists:users,id',
            'selectedRole' =>  'required|in:member,sub_leader'
        ]);
            // تحقق أن groupId و groupName موجودين
        if (!$this->groupId || !$this->groupName) {
            session()->flash('error', 'بيانات المجموعة غير مكتملة. لا يمكن إرسال الدعوات.');
            return;
        }
         foreach ($this->selectedUsers as $userId) {
            $user = User::find($userId); // هنا userId هو ID العضو المُدعو

            if ($user) {
                // يتم استخدام userId تلقائيًا من خلال $user->groups() في attach
                $user->groups()->attach($this->groupId, [
                    'role' => $this->selectedRole ?? 'member',
                    'status' => 'pending',
                     'invited_by' => Auth::id(), 
                     'invited_at' => now()->format('Y-m-d'), 
                ]);
                // إرسال إشعار
                $user->notify(new GroupInvitationNotification(
                    $this->groupId,
                    $this->groupName,
                    Auth::user()->name // اسم من قام بالدعوة
                ));
                session()->flash('message', 'تم إرسال الدعوة بنجاح');
            }else{
                session()->flash('message', 'لم يتم إرسال الدعوة');
            }
        }
    }
    public function confirmDeletion($memberId)
    {
                $this->confirmingDelete = true;
                $this->memberToDeleteId = $memberId;
       // إظهار رسالة التأكيد باستخدام emit
        $this->dispatch('showDeleteConfirmation', $memberId);
    }
 public function removeMember($userId)
{
    try {
        // تحقق من أن العضو موجود
        $user = User::find($userId);
        if ($user) {
            // حذف العضو من المجموعة
            $this->group->members()->detach($userId);
               $this->confirmingDelete = false; // إغلاق نافذة التأكيد بعد الحذ
            // إرسال الإشعار للمستخدم
            $user->notify(new MemberRemovedNotification(
                $this->group, 
                'member_removed', 
                Auth::user()
            ));
            // تحديث الواجهة مع رسالة نجاح
            session()->flash('message', 'تم حذف العضو من المجموعة بنجاح');
            // إعادة تفعيل الأحداث أو إعادة تحميل الكومبوننت
            $this->dispatch('memberUpdated');
        } else {
            // في حالة العضو غير موجود
            session()->flash('error', 'العضو غير موجود في قاعدة البيانات');
        }
    } catch (\Exception $e) {
        // في حالة حدوث خطأ
        session()->flash('error', 'لم يتم الحذف: ' . $e->getMessage());
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
