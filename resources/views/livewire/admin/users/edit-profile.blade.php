@extends('layouts.admin')

@section('admin-content')
<div class="max-w-4xl mx-auto mt-10 bg-white rounded-xl shadow-md p-6">
    <h2 class="text-2xl font-semibold mb-6 text-center">✏️ تعديل الملف الشخصي</h2>

    <form method="POST" action="{{ route('admin.users.update', $user->id) }}" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')
        {{-- الاسم --}}
        <div>
            <label class="block mb-2 font-medium">👤 الاسم الكامل</label>
            <input type="text" name="name" value="{{ old('name', $user->name) }}" required
                class="w-full border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200">
        </div>
        {{-- الاسم --}}
        <div>
            <label class="block mb-2 font-medium">👤 اسم المستخدم</label>
            <input type="text" name="username" value="{{ old('username', $user->username) }}" required
                class="w-full border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200">
        </div>

        {{-- البريد الإلكتروني --}}
        <div>
            @if (auth()->user()->role === 'admin')   
            <label class="block mb-2 font-medium">📧 البريد الإلكتروني</label>
            <input type="email" name="email" value="{{ old('email', $user->email) }}" required
            class="w-full border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200">
        </div>
        @endif
        {{-- رقم الهاتف --}}
        <div>
            <label class="block mb-2 font-medium">📞 رقم الهاتف</label>
            <input type="text" name="phone" value="{{ old('phone', $user->phone) }}"
                class="w-full border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200">
        </div>
        {{-- الدور (مقفل إذا كان المستخدم نفسه) --}}
        @if(auth()->user()->role === 'admin')
        <div>
            <label class="block mb-2 font-medium">🏢 الدور</label>
            <select name="role" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200">
                <option value="user" @selected($user->role === 'user')>مستخدم</option>
                <option value="manager" @selected($user->role === 'team_leader')>مدير مجموعة</option>
                <option value="admin" @selected($user->role === 'admin')>مدير عام</option>
            </select>
        </div>
        @endif

        {{-- زر الحفظ --}}
        <div class="text-center">
            <button type="submit"
                class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">💾 حفظ التعديلات</button>
        </div>
    </form>
</div>
@endsection
