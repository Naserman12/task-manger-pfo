<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use App\Models\Group;
use App\Models\User;
use Illuminate\Http\Request;


class NotificationController extends Controller
{
    public function show($notification){
        $notification = Auth::user()->notification->findOrFail($notification);
        if ($notification->unread) {
           $notification->markAsRead();
        }
        return view('notifications.show', compact('notification'));
    }
    public function index(){
        $user = Auth::user();
        return view('notifications.index', [
                'notifiations' => $user->notifications->paginate(10),
                'unreadCount' => $user->unreadNotifications->count()
        ]);
    }
    public function accept($notification){
        $group = Group::findOrFail($notification->data['group_id']);
        $group->members()->updateExistingPivot(Auth::id(),[
            'status' => 'accept',
            'joined_at' => now()->format('Y-m-d')
        ]);
        $notification->markAsRead();
        session('message', 'تم قبول الدعوة');
    }
    public function reject($notification){
        $group = Group::findOrFail($notification->data['group_id']);
        $group->members()->detach(Auth::id());
        $notification->markAsRead();
    }
    public function markAllAsRead(){
        Auth::user()->unreadNotifications->markAsRead();
        return back()->with('success', 'تم تعيين جميع الإشعارات كمقروءة');
    }
    public function markAsRead($notificationId){
        $notification = Auth::user()->notification->findOrFail($notificationId);
        $notification->markAsRead();
        return back()->with('toast',['type' => 'success', 'message' => 'تم تحديث حالة الإشعار']);
    }
}
