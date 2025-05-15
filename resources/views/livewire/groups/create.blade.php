@if (Auth()->user()->role === 'admin')
@extends('layouts.admin')
@section('admin-content')
@livewire('groups.group-form' )
@endsection

@endif
