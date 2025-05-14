<?php

namespace App\Livewire;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Notifications\Notifiable;
class ShowAllNotifications extends Component
{
        use WithPagination; // إضافة التصفح
    public function render()
    {
         $notifications = Auth::user()->notifications()->paginate(5); // تحديد عدد الإشعارات لكل صفحة
        return view('livewire.show-all-notifications', compact('notifications'));
    }
}
