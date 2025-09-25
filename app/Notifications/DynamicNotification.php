<?php 
namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\BroadcastMessage;

class DynamicNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public $data;
    public function __construct(array $data)
    {
        $this->data = $data; // يحتوي على كل البيانات الديناميكية
    }
    public function via($notifiable)
    {
        return ['database', 'broadcast'];
    }
    public function toArray($notifiable)
    {
        return array_merge($this->data, [
            'notifiable_id' => $notifiable->id,
            'notifiable_type' => get_class($notifiable)
        ]);
    }
        public function toDatabase($notifiable)
    {
        return $this->toArray($notifiable);
    }
    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage($this->toArray($notifiable));
    }
}
