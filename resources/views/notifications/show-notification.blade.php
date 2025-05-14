@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h1 class="text-xl font-bold mb-4">تفاصيل الإشعار</h1>
    @livewire('show-notification', ['notificationId' => $notificationId])
</div>
@endsection
