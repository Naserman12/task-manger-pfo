<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TaskNotification extends Notification
{
    use Queueable;
    
    /**
     * Create a new notification instance.
     */
    public  $task;
    public  $eventType ;// member_added, role_changed, etc.
    public  $triggeredBy = null; // ?user
    public function __construct(){

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
                    ->line($this->getMessage())
                    ->action('عرض المجموعة', $this->getUrl());
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'group_id' => $this->task->id,
            'event_type' => $this->eventType,
            'message' => $this->getMessage(),
            'url' => $this->getUrl()
        ];
    }
    public function getSubject(){
        return match($this->eventType){
            'member_added' => 'إضافة الى المجموعة {$this->group->name}',
            'role_changed' => '  تحديث دور  في  {$this->group->name}',
            default => 'تحديث  في المجموعة'
        };
    }
    public function getMessage(){
        $initiator = $this->triggeredBy?->name ?? 'النظام';
        return match($this->eventType){
            'member_added' => '{$initiator} إضافة الى المجموعة {$this->group->name}',
            'role_changed' => '{$initiator} قام بغيير دورك  الى  {$this->getRoleName()}',
            default => 'حدث جديد في المجموعة'
        };
    }
    private function getUrl(){
        return route('groups.show', $this->task->id);
    }
}
