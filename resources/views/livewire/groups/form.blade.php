@extends('layouts.app')
@section('content')
<div class="container mx-auto px-4 py-8">
    @if (session('success'))
    <div class="bg-green-100 border-1-4 border-green-500 text-green-700 p-4 mb-4">
        {{ session('success') }}
    </div>
    @endif
    @livewire('group-form')
</div>
@endsection