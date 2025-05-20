<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public $user ;
    public function index() {   
        $users = User::all();  // أو استخدم علاقة أو فلتر حسب حاجتك
        return view('livewire.admin.users.index', compact('users'));
    }
    public function show($id){
        $user = User::withCount(['sharedProjects', 'tasks'])->findOrFail($id);

        return view('livewire.admin.users.show-profile', [
    'user' => $user->loadCount(['sharedProjects', 'tasks']) // إذا كانت لديك علاقات
        ]);

    }
    // update Method
    public function update(Request $request, User $user)    {
    abort_unless(Auth::id() === $user->id || Auth::user()->role === 'admin', 403);

    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'username' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,' . $user->id,
        'phone' => 'nullable|string|max:20',
        'role' => 'nullable|in:user,manager,admin',
    ]);

    // لا يحق للمستخدم تعديل دوره
    if (Auth::user()->role !== 'admin') {
        unset($validated['role']);
    }

    $user->update($validated);
    return redirect()->route('show-profile', $user->id)->with('message', 'تم تحديث البيانات بنجاح');
}
    // update Method End
    public function edit(User $user) {
    $this->user = $user;
      abort_unless(Auth::id() === $this->user->id, 403);
    return view('livewire.admin.users.edit-profile', compact('user'));
}

    // public function edit($id)
    // {
    //     $user = User::findOrFail($id);
    //     return view('', compact('user'));
    // }
public function destroy(User $user){
    // فقط المدير يملك صلاحية الحذف النهائي
    abort_unless(Auth::user()->role === 'admin', 403);

    // منع المدير من حذف نفسه عن طريق الخطأ
    if (Auth::id() === $user->id) {
        return back()->with('error', 'لا يمكنك حذف حسابك الخاص.');
    }

    $user->delete();

    return redirect()->route('admin.users')->with('message', 'تم حذف المستخدم نهائيًا.');
}
public function updateRole(Request $request, User $user)
{
    abort_unless(Auth::user()->role === 'admin', 403);

    $request->validate([
        'role' => 'required|in:user,manager,admin',
    ]);

    $user->role = $request->role;
    $user->save();

    return back()->with('message', 'تم تحديث دور المستخدم بنجاح');
}




}