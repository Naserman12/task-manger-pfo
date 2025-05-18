@extends('layouts.admin')
@section('admin-content')
@livewire('admin.project.project-form', ['id' => $id])
@endsection
