@extends('layouts.admin') {{-- أو أي layout تستخدمه --}}
@section('admin-content')
   @livewire('groups.tasks.task-details',   ['task' => $task])
@endsection
