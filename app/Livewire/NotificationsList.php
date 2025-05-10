<?php

namespace App\Livewire;
use Illuminate\Support\Facades\Auth;
use Illuminate\Container\Attributes\Database;
use Livewire\Component;

class NotificationsList extends Component
{
    public $notificationId;
    public $showDropdown = false;
    public $notifications = [], $notification;
     public $unreadCount;
    public function mount(){
        // $this->notificationId = $notificationId;
        $this->unreadCount = Auth::user()->unreadNotifications->count();
        $this->loadNotification();
    }
    public function loadNotification(){
    
    }
    public function markAsRead($id){
        $notification = Auth::user()
        ->notifications->findOrFail($id);
    if ($this->notification) {
        $this->notification->markAsRead();
    }
    }
    public function markAllAsRead($id){
        Auth::user()
        ->unreadNotifications->markAsRead();
        $this->showDropdown = false;
        $this->loadNotification();
    }
    public function getNotifications(){
        return Auth::user()
                ->notifications
                ->latest()->paginate(10);
    }
    public function toggleDropdown(){
        $this->showDropdown = !$this->showDropdown;
    }
    public function render()
    {
        return view('livewire.notifications-list', [
            'notifications' => $this->notifications
        ]);
    }
}
