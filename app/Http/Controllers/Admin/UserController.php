<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        
        $users = User::all();  // أو استخدم علاقة أو فلتر حسب حاجتك
        return view('livewire.admin.users.index', compact('users'));
    }
    public function edit($id)
{
    $user = User::findOrFail($id);
    return view('livewire.admin.users.edit', compact('user'));
}
public function destroy($id)
{
    $user = User::findOrFail($id);
    $user->delete();
    return redirect()->route('admin.users')->with('success', 'تم الحذف بنجاح');
}
}