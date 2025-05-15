<?php

namespace App\Http\Livewire;

use App\Models\Group;
use Livewire\Component;
use App\Models\GroupUser;
class GroupMemberDashboard extends Component
{
    public $groupId;
    public $members;
    public function mount($groupId)
    {
        $this->groupId = $groupId;
        $this->loadMembers();
    }
    public function loadMembers()
    {
        $this->members = GroupUser::where('group_id', $this->groupId)->get();
    }
    public function acceptInvitation($memberId)
    {
        $member = GroupUser::find($memberId);
        $member->update(['status' => 'accepted']);
        $this->loadMembers(); // تحديث الأعضاء بعد القبول
        session()->flash('message', 'تم قبول الدعوة بنجاح.');
    }
    public function rejectInvitation($memberId)
    {
        $member = GroupUser::find($memberId);
        $member->update(['status' => 'rejected']);
        $this->loadMembers(); // تحديث الأعضاء بعد الرفض
        session()->flash('message', 'تم رفض الدعوة.');
    }

    public function showGroupMembers($groupId)
    {
        $group = Group::findOrFail($groupId);

        // اجلب الأعضاء المرتبطين بالمجموعة
        $members = $group->members;

        return view('livewire.group-member-dashboard', compact('group'));
    }

}
