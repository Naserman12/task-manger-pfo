@extends('layouts.admin')

@section('admin-content')
<!-- الرسائل -->
@if(session('message'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mt-4">
        {{ session('message') }}
    </div>    
@endif
<div class="container mx-auto py-8">
    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <div class="bg-blue-600 px-6 py-4 flex items-center justify-between">
            <h1 class="text-2xl font-bold text-white">تفاصيل المجموعة: {{ $group->name }}</h1>
            <div class="flex space-x-4 space-x-reverse">
                @if (Auth()->user()->role === 'admin' || auth()->user()->role === 'team_leader')
                    
                <a href="{{ route('groups.edit', $group->id) }}"
                class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-lg">
                تعديل 📝
            </a>
            @livewire('delete-group', ['groupId' => $group->id], key('delete-'.$group->id))
            @endif
            </div>
        </div>
    </div>   
    <!-- محتوى الصفحة -->
    <div class="p-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <!-- معلومات اساسية -->
            <div class="space-y-4">
                <div>
                    <h2 class="text-xl font-semibold text-gray-800">المعلومات الأساسية</h2>
                    <div class="mt-2 space-y-2">
                        <p><span class="font-medium">اسم المجموعة:</span> {{ $group->name }}</p>
                        <p><span class="font-medium">تاريخ الإنشاء:</span> {{ $group->created_at->format('Y-m-d H:i:s') }}</p>
                    </div>
                </div>
                <!-- المشرف -->
                <div>
                    <h2 class="text-xl font-semibold text-gray-800">منشئ المجموعة</h2>
                    <div class="mt-2 flex items-center space-x-3 space-x-reverse">
                        <div class="bg-blue-500 text-white rounded-full h-10 w-10 flex items-center justify-center">
                            {{ substr($group->leader->name, 0, 1) }}
                        </div>
                        <div>
                            <p class="font-medium">{{ $group->leader->name }}</p>
                            <p class="text-sm text-gray-500">{{ $group->leader->email }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- الأعضاء -->
        <div class="mt-10">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">أعضاء المجموعة</h2>
            <div class="bg-white text-gray-800 p-6 rounded-lg shadow">
                @if (Auth()->user()->role === 'admin' || auth()->user()->role === 'team_leader')   
                @livewire('groups.group-members', ['groupId' => $group->id], key('member-'.$group->id))
                @endif
            </div>
        </div>

        <!-- المهام المرتبطة -->
        <div class="mt-8">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">مهام المجموعة</h2>
            <div class="bg-gray-50 p-4 rounded-lg">
                <!-- المهام ستُضاف هنا لاحقًا -->
            </div>
        </div>
    </div>
</div>
@endsection
