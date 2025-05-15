@if (Auth()->user()->role === 'admin')
@extends('layouts.admin')
@section('admin-content')
<div class="container mx-auto py-8">
    @livewire("groups.group-form", ['groupId' => $group->id])
</div>
@endsection
@else
@extends('layouts.app')
@section('content')
<div class="container mx-auto py-8">
    @livewire("groups.group-form", ['groupId' => $group->id])
</div>
@endsection
@endif