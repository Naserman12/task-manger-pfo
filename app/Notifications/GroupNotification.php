<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Notifications\Notification;

class GroupNotification extends Notification
{
    use Queueable;

    public $eventType;
    public $group;
    public $triggeredBy;

    public function __construct($group, $triggeredBy, $eventType = 'حدث في المجموعة')
    {
        $this->group = $group;
        $this->triggeredBy = $triggeredBy;
        $this->eventType = $eventType;
    }

    public function via(object $notifiable): array
    {
        return ['database'];
    }
    public function toDatabase($notifiable)
    {
        return [
            'type' => 'group_update',
            'group_id' => $this->group->id,
            'event_type' => $this->eventType,
            'message' => $this->getMessage(),
            'url' => route('notifications.show', $this->group->id),
            'icon' => 'users',
            'triggered_by' => $this->triggeredBy->name,
            'notifiable_id' => $notifiable->id,
            'notifiable_type' => get_class($notifiable)
        ];
    }

    public function toArray(object $notifiable): array
    {
        return [
            'type' => 'group_update',
            'group_id' => $this->group->id,
            'event_type' => $this->eventType,
            'message' => $this->getMessage(),
            'url' => route('notifications.show', $this->group->id),
            'icon' => 'users',
            'triggered_by' => $this->triggeredBy->name
        ];
    }

    public function getSubject()
    {
        return match ($this->eventType) {
            'member_added' => "{$this->triggeredBy->name} أضافك إلى المجموعة '{$this->group->name}'",
            'role_changed' => "{$this->triggeredBy->name} غيّر دورك إلى '{$this->getRoleName()}'",
            'member_removed' => "تمت إزالتك من المجموعة '{$this->group->name}'",
            default => 'حدث جديد في المجموعة'
        };
    }

    public function getMessage()
    {
        return match ($this->eventType) {
            'member_added' => "أُضيفت إلى المجموعة '{$this->group->name}' بواسطة {$this->triggeredBy->name}",
            'role_changed' => "تم تحديث دورك في المجموعة '{$this->group->name}' إلى {$this->getRoleName()}",
            'member_removed' => "تمت إزالتك من المجموعة '{$this->group->name}'",
            default => "تحديث جديد في المجموعة '{$this->group->name}'"
        };
    }

    private function getRoleName()
    {
        $role = $this->group->members()
            ->where('user_id', $this->triggeredBy->id)
            ->first()
            ?->pivot->role;

        return match ($role) {
            'member' => 'عضو',
            'sub_leader' => 'مساعد مشرف',
            'leader' => 'مشرف',
            default => 'عضو'
        };
    }
}
