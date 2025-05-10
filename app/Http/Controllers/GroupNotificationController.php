<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\Group;
use Illuminate\Http\Request;

class GroupNotificationController extends Controller
{
   
    public function groupNotifications($group)  {
        return view('groups.notification', [
            'group' => $group,
            'notification' => $group->notifications()
                ->whit('notification', Auth::id())
                ->paginate(10)

        ]);
    }
}
