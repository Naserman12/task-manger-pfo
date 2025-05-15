@extends('layouts.admin')
@section('admin-content')

<h1 class="text-3xl font-bold mb-6">مرحباً بك في لوحة تحكم المدير</h1>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white p-6 rounded shadow">
            <h2 class="text-xl font-semibold">عدد المهام</h2>
            <p class="text-3xl mt-2">12</p>
        </div>
        <div class="bg-white p-6 rounded shadow">
            <h2 class="text-xl font-semibold">عدد المجموعات</h2>
            <p class="text-3xl mt-2">5</p>
        </div>
        <div class="bg-white p-6 rounded shadow">
            <h2 class="text-xl font-semibold">عدد المستخدمين</h2>
            <p class="text-3xl mt-2">20</p>
        </div>
    </div>
    @endsection

