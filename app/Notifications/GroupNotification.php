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

    /**
     * Create a new notification instance.
     */
    public  $eventType,  $group;
    public function __construct( $group,  public $triggeredBy, $eventType = 'حدث في المجموعة')
{
    $this->group = $group;
    $this->triggeredBy = Auth::user();
    $this->eventType = $eventType;
    $this->group = $group;
  
}
    public function toDatabase($notifiable){
        return[
            'group_id' => $this->group->id,
            'message' => 'تمت إضافتك إلى المجموعة:'.$this->group->name,
            'notifiable_id' => $notifiable->id,
            'notifiable_type' => get_class($notifiable)
        ];
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
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->subject($this->getSubject())
                    ->markdown('emails.notifications.group',[
                        'message' => $this->getMessage(),
                        'url' => route('groups.show', $this->group->id)
                    ]);
                }
                public function toArray(object $notifiable): array{
                    return [
                        'type' => 'group_update',
                        'group_id' => $this->group->id,
                        'event_type' => $this->eventType,
                        'message' => $this->getMessage(),
                        'url' =>  route('groups.show', $this->group->id),
                        'icon' => 'users',
                        'triggered_by' => $this->triggeredBy->name
                    ];
                }
                public function getSubject(){
                    
                    return match($this->eventType){
                        'member_added' => "{$this->triggeredBy} إضافة الى المجموعة '{$this->group->name}'",
                        'role_changed' => "{$this->triggeredBy} قام بغيير دورك  الى  '{$this->getRoleName()}'",
                        'member_removed' => "  تم إزالتك من المجموعة {$this->group->name}",
                        default => 'حدث جديد في المجموعة'
                    };
                }
                public function getMessage(){
                    return match($this->eventType){
                        'member_added' => "إضافة الى المجموعة '{$this->group->name}' بوسطة {$this->triggeredBy->name}",
                        'role_changed' => "  تحديث دور  في  '{$this->group->name}' بواسطة {$this->getRoleName()}",
                        'member_removed' => '  تم إزالتك من المجموعة {$this->group->name}',
                        default => 'تحديث  في المجموعة'
                    };
                }
                private function getRoleName(){
                    $role = $this->group->members()
                    ->where('user_id', $this->triggeredBy->id)
                        ->first()
                        ->pivot->role;
                        return match($role){
                            'member' => 'عضو',
                            'sub_leader' => 'مساعد مشرف',
                            'leader' => 'مشرف',
                            default => $role
                        };
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    private function getUrl(){
        return route('groups.show', $this->group->id);
    }
}
