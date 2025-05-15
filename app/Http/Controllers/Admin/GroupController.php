<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Group;


class GroupController extends Controller
{
      public function index()
    {
        $groups = Group::withCount('members')->get();
        return view('livewire.admin.groups.index', compact('groups'));
    }

    public function edit($id)
    {
        // صفحة تعديل المجموعة
    }

    public function destroy($id)
    {
        // حذف المجموعة
    }
}
