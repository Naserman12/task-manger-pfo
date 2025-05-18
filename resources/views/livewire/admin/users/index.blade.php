@extends('layouts.admin')
@section('admin-content')
<div>
    <div class="container w-full sm:w-1/2 md:w-1/3 lg:w-1/4">

        {{-- In work, do what you enjoy. --}}
        <h3 class="text-xl font-semibold">المستخدمين</h3>
<table class="min-w-full bg-white border border-gray-300">
    <thead>
        <tr>
            <th class="px-4 py-2 text-left">الاسم</th>
            <th class="px-4 py-2 text-left">البريد الإلكتروني</th>
            <th class="px-4 py-2 text-left">الدور</th>
            <th class="px-4 py-2 text-left">الإجراءات</th>
        </tr>
    </thead>
    <tbody>
        @foreach($users as $user)
            <tr>
                <td class="px-4 py-2">{{ $user->name }}</td>
                <td class="px-4 py-2">{{ $user->email }}</td>
                <td class="px-4 py-2">{{ $user->role }}</td>
                <td class="px-4 py-2">
                    <a href="{{ route('admin.users.edit', $user->id) }}" class="text-blue-600">تعديل</a>
                    <a href="{{ route('admin.users.delete', $user->id) }}" class="text-red-600">حذف</a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
</div>
</div>
@endsection
