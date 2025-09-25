<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Group;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\GroupUser;
use App\Notifications\DynamicNotification;
use App\Models\Notification;
use App\Models\NotificationType;
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
        $member->update(['status' => 'accepted',
                          'joined_at' => now(),
                          'responded_at' => now(),
      ]);
         // الحصول على المستخدم الداعي
    $inviter = User::find($member->invited_by);
    // جلب نوع الإشعار من جدول notification_types
    $type = NotificationType::where('name', 'accepted_invitation')->first();
    // إنشاء الإشعار
    $inviter->notify(new DynamicNotification([
        'notification_type_id' => $type->id,
        'notifiable_type' => get_class($inviter),
        'notifiable_id' => $inviter->id,
        'data' => [
        'message' => '📬 قام ' . Auth::user()->name . ' بقبول دعوتك للانضمام إلى المجموعة.',
        'group_id' => $this->groupId,
        'url' => route('notifications.show', $this->groupId),
        'created_by' => Auth::id(),
        ],
    ]));

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
