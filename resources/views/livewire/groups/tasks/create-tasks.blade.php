@extends('layouts.admin')
 {{-- In work, do what you enjoy. --}}
@section('admin-content')
@livewire('groups.tasks.distribute-tasks', ['group' => $group, 'project' => $project])
@endsection