<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class GroupMemberController extends Controller
{
    public function respond(Request $request, $group){
        $request->validate([
            'response' => 'required|in:accetpt,reject'
        ]);
        $member = $group->members()->where('user_id', Auth::id())->firstOrFail();

        if ($request->response === 'accept') {
            $group->members()->updateExistingPivot(auth::id(), [
                'status' => 'accepted',
                'joined_at' => now()->format('Y-m-d')
            ]);
            return redirect()->route('groups.show'.$group)
                ->with('toast', [
                    'type' => 'success',
                    'message' => 'تم رفض الدعوة'
                ]);
        }else{
                $group->members()->detach(Auth::id());
            return redirect()->route('groups.index')
                ->with('toast', [
                    'type' => 'info',
                    'message' => 'تم رفض الدعوة'
                ]);
        }
    }
}
