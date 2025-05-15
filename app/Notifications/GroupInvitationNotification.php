<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Auth;

class GroupInvitationNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    protected $groupId,  $groupName, $inviterName;
    public function __construct($groupId, $groupName, $inviterName)
    {
      $this->groupId = $groupId;
      $this->groupName = $groupName;
      $this->inviterName = $inviterName;
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
    public function toArray(object $notifiable): array
    {
        return [
            'type' => 'group_invitation',
            'group_id' => $this->groupId,
            'group_name' => $this->groupName,
            'inviter_name' => $this->inviterName,
            'icon' => 'users',
            'url' => route('notifications.show', $this->groupId),
            'message' => "تمت دعوتك للانضمام إلى مجموعة : '{$this->groupName}' بواسطة '{$this->inviterName}'" 
        ];
    }
}
