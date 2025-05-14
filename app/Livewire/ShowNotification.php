<?php
namespace App\Livewire;

use Livewire\Component;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use App\Models\Group;

class ShowNotification extends Component
{
    public $notificationId;
    public $notificationDetails;
    public $notification;
    public $type, $details;
    public $accepted, $userGroup, $group;
    public $groupId, $status = 'pending';
    public $user;


    public function mount($notificationId)
    {
        $this->user = Auth::user();
        $this->notification = $this->user->notifications()->find($notificationId);
        if (!$this->notification) {
            abort(404, 'الإشعار غير موجود');
        }
        // تعليم كمقروء
        if ($this->notification->unread()) {
            $this->notification->markAsRead();
        }
        $this->type = class_basename($this->notification->type);
        $this->details = $this->notification->data ?? 'unknown';
        $this->user = Auth::user(); 
         // 👇 فقط نفذ منطق القبول إذا كان نوع الإشعار "دعوة إلى مجموعة"
    if (isset($this->details['type']) && $this->details['type'] === 'group_invitation') {
        $this->groupId = $this->details['group_id'];
        $this->group = Group::with(['members' => function ($q) {
            $q->withPivot(['status', 'joined_at', 'invited_by']);
        }])->find($this->groupId);

        if ($this->group) {
            $this->userGroup = $this->group->members()
                ->where('user_id', $this->user->id)
                ->first();
        } else {
            $this->userGroup = null;
        }
    }
        }
 public function accept()
{
                if (!$this->groupId) {
                session()->flash('error', 'معرف المجموعة غير موجود.');
                return;
            }

            if ($this->userGroup && $this->userGroup->pivot) {
                $this->status = $this->userGroup->pivot->status;
            } else {
                $this->status = 'pending';
            }
        // تحديث حالة القبول في قاعدة البيانات
        if ($this->userGroup) {
            // تحديث حالة العضو في جدول pivot إلى accepted
       $this->group->members()->updateExistingPivot($this->user->id,[ 
            'status' => 'accepted',
            'updated_at' => now()->format('y-m-d'),
            'joined_at' => now()->format('y-m-d')]);
            // قم بتعيين القيمة في المتغيرات لتحديث الحالة في الـ Livewire
              $userId  = $this->user->id;
            $group = Group::with(['members' => function ($query) use ($userId) {
                  $query->where('id', $userId)->withPivot(['status', 'joined_at']);
                            }])->find($this->groupId);

                            $this->userGroup = $group->members->first();

    session()->flash('message', 'تم قبول الدعوة بنجاح.');
            session()->flash('message', 'تم قبول الدعوة بنجاح.');
        } else {
            session()->flash('error', 'تعذر العثور على بيانات المجموعة أو العضو.');
        }
    }
       public function reject()
{
    if (!isset($this->details['type']) || $this->details['type'] !== 'group_invitation') {
        session()->flash('error', 'هذا الإشعار لا يحتوي على دعوة.');
        return;
    }

    if (!$this->groupId || !$this->user) {
        session()->flash('error', 'تعذر تحديد المجموعة أو المستخدم.');
        return;
    }

    // جلب المجموعة
    $group = Group::find($this->groupId);

    if (!$group) {
        session()->flash('error', 'المجموعة غير موجودة.');
        return;
    }

    // تحديث بيانات الدعوة في جدول pivot
    $group->members()->updateExistingPivot($this->user->id, [
        'status' => 'rejected',
        'responded_at' => now(),
        'updated_at' => now(),
    ]);

    // إعادة تحميل العضو من العلاقة لتحديث الحالة
    $userId = $this->user->id;
    $group = Group::with(['members' => function ($query) use ($userId) {
        $query->where('id', $userId);
    }])->find($this->groupId);

    $this->userGroup = $group->members->first();

    session()->flash('message', 'تم رفض الدعوة بنجاح.');
}


    public function render()
    {
        return view('livewire.show-notification', ['notification' => $this->notification])->layout('layouts.app');
    }
}
