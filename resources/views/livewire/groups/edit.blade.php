@extends('layouts.app')
@section('content')
    <div class="container mx-auto py-8">
        @livewire("groups.group-form", ['groupId' => $group->id])
    </div>
@endsection