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
    protected $groupId,  $groupName, $role;
    public function __construct($groupId, $groupName, $role)
    {
      $this->groupId = $groupId;
      $this->groupName = $groupName;
      $this->role = $role;
       
    }
    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database', 'mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage);
                    // ->subject('دعوة للانضمام إلى مجموعة' . $this->group->name)
                    // ->markdown('emails.notifications.invitation', [
                    //     'group' => $this->group,
                    //     'invited_by' => $this->inviter,
                    //     'url' => route('group-members.respond')
                    // ]);
        
    }

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
            'inviter_name' => $this->role,
            'message' => "تمت دعوتك للانضمام إلى مجموعة : {$this->groupName} بدور {$this->role}" 
        ];
    }
}
