<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class MemberRemovedNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
        

    public function __construct( public $group, public $action, public $actor)
    {
            $this->group = $group;
            $this->action = $action; // member_removed
            $this->actor = $actor; 
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     */

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    
    public function toDatabase($notifiable)
    {
        return [
                    'group_name' => $this->group->name,
                    'action' => $this->action,
                    'actor_name' => $this->actor->name,
                    'actor_role' => $this->actor->role,
                    'url' => route('groups.show', $this->group->id), // أضف هذا السطر
                     'message' => "{$this->actor->name} قام بحذفك من المجموعة '{$this->group->name}'.",
        ];
    }
    public function toArray($notifiable)
    {
        return [
            // 'message' => "{$this->actor->name} قام بحذفك من المجموعة {$this->group->name}.",
        ];
    }

}
