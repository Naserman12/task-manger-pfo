<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\User;
use Illuminate\Http\Request;
use  Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;


class ControllerGroup extends Controller
{
public function create(){
    return view('groups.fomr', [
        'users' => User::all(),
        'isEdit' => false,
    ]);
}
public function edit(Group $group){
    return view('groups.form', [
        'group' => $group,
        'users' => true
    ]);
}
public function store(Request $request){
    $validated = $request->validate([
        'name' => 'required|max:55',
        'leader_id' => 'required|exists:users,id',
    ]);
    $group = Group::create($validated);
    return redirect()->route('groups/index')->with('seccess', 'تم الإضافة بنجاح');
}
public function update(Request $request, Group $group){
    $validated = $request->validate([
        'name' => 'required|max:55',
        'leader_id' => 'required|exists:users,id',
    ]);
    $group->update($validated);
    return redirect()->route('groups.index');
}
    public function save(Request $request, $id ){
        $request->validate([
            'name' => 'required|string|max:56',
            'leader_id' => 'required|exists:users,id',
        ]);
        $group = $id ? Group::findOrFail($id) :new Group();
        $group->name = $request->name;
        $group->leader_id = $request->leader_id;
        $group->save();

        if (!$id) {
            $group->members()->attach($request->leader_id, [
                'role' => 'admin',
                'status' => 'accepted',
                'invited_id' => Auth::id(),
                'token' => Str::random(40),
            ]);
        }
        // return response()->json(['success' => true, 'group' => $group]);
    }
    public function inviteMember(Request $request, $groupId){
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'role' => 'required|in:member,admin',
        ]);
        $group = Group::findOrFail($groupId);
        $group->members()->attach($request->user_id, [
            'role' => $request->role,
            'status' => 'pending',
            'invited_by' => auth::id(),
            'token' => Str::random(40),
            'invited_at' => now(),
        ]);

        // إرسال إشغارات للمستخدم
        // return response()->json(['seccess' => true]);
    }
}
