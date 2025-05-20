@extends('layouts.admin')

@section('admin-content')
<div class="p-4 space-y-6">
     <!-- الرسائل -->
    @if (session('message'))
    <div class="bg-green-100 border border-green-500 text-green-700 px-4 py-3 rounded mb-4">
         {{ session('message') }} 
    </div>    
    @endif
    {{-- العنوان العام --}}
    <h2 class="text-2xl font-bold text-gray-800">👥 عرض المستخدمين</h2>
    {{-- البحث والفلترة --}}
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <input type="text" placeholder="🔍 بحث بالاسم/البريد..." class="w-full md:w-1/3 px-4 py-2 border rounded-md focus:outline-none focus:ring focus:border-blue-300">
        
        <select class="w-full md:w-1/4 px-4 py-2 border rounded-md focus:outline-none">
            <option value="">🏷️ فلترة حسب الدور</option>
            <option value="admin">مدير</option>
            <option value="designer">مصمم</option>
            <option value="developer">مطور</option>
        </select>
    </div>

    {{-- للموبايل: عرض مبسط --}}
    <div class="md:hidden space-y-4">
        @foreach ($users as $user)
            <div class="bg-white shadow-md rounded-md p-4 flex justify-between items-center border-l-4
                        @if($user->role == 'مدير نظام') border-green-500
                        @elseif($user->role == 'مصمم') border-yellow-500
                        @else border-red-500 @endif">
                <div>
                    <p class="font-semibold">{{ $user->name }} <span class="text-sm text-gray-500">({{ $user->role }})</span></p>
                    @if (auth()->user()->role === 'admin')       
                    <p class="text-sm text-gray-600">{{ $user->email }}</p>
                    @endif
                </div>
                <a href="{{ route('admin.users.edit', $user->id) }}" class="text-blue-600 text-sm">تعديل</a>
            </div>
        @endforeach
        <div class="text-center text-gray-500">عرض الكل ({{ count($users) }})</div>
    </div>
    {{-- للحاسوب: جدول مفصل --}}
    <div class="hidden md:block">
        <table class="min-w-full bg-white shadow-md rounded-md overflow-hidden border border-gray-200">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-2 text-right">الصورة</th>
                    <th class="px-4 py-2 text-right">الاسم</th>
                    @if (auth()->user()->role === 'admin')
                        
                    @endif
                    <th class="px-4 py-2 text-right">البريد الإلكتروني</th>
                    <th class="px-4 py-2 text-right">الدور</th>
                    <th class="px-4 py-2 text-right">الإجراءات</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr class="border-t">
                        <td class="px-4 py-2 text-center">👤</td>
                        <td class="px-4 py-2">{{ $user->name }}</td>
                        @if (auth()->user()->role  === 'admin')
                        <td class="px-4 py-2">{{ $user->email }}</td>
                        @endif
                        <td class="px-4 py-2">{{ $user->role }}</td>
                        <td class="px-4 py-2 space-x-2">
                            <a href="{{ route('show-profile', $user->id) }}" class="text-blue-600 hover:underline">عرض  المستخدم</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-4 flex justify-between items-center text-sm text-gray-600">
            <span>📊 {{ count($users) }} مستخدم</span>
            <button class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">📥 تصدير كـ PDF</button>
        </div>
    </div>

</div>
@endsection
