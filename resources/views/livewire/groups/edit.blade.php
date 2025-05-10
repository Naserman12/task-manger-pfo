@extends('layouts.app')
@section('content')
    <div class="container mx-auto py-8">
        <h1 class="text-2x1 font-bold mb-6">تعديل المجموعة </h1>
        @livewire("groups.group-form", ['groupId' => $group->id])
    </div>
@endsection