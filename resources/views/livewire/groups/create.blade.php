@if (Auth()->user()->role === 'admin')
@extends('layouts.admin')
@else
@extends('layouts.app')
@endif
@section('content')
@livewire('groups.group-form' )
@endsection