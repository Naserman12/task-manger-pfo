@extends('layouts.admin')
@section('content')
    <div class="p-4">
        <h2 class="text-2xl font-semibold mb-4">لوحة تحكم المدير</h2>
        <!-- عرض المحتوى بناءً على الصفحة المختارة -->
        @yield('admin-content')
    </div>
@endsection
