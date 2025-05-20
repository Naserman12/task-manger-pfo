@if (Auth()->user()->role === 'admin' || auth()->user()->role === 'team_leader')
@extends('layouts.admin')
@section('admin-content')
@livewire("groups.group-form", ['groupId' => $group->id])
@endsection
@else
@section('admin-content')
<div class="text-center bg-yellow-100 border border-yellow-400 text-yellow-800 p-4 rounded">
                ⚠️ لا  يمكنك الوصول للصفحة .
</div>
@endsection
@endif