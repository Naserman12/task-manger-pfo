@extends('layouts.app')
@section('content')
<div>
    <div class="container max-auto px-4 py-8">
        @if ($groups && $groups->count() > 0)   
        <div class="felx justify-between items-center bm-8">
            <h1 class="text-3xl font-bild text-gray-800">قائمة المجموعات</h1>
            <a href="{{ route('groups.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded-lg transition duration-200">إنشاء مجموعة</a>
        </div>
    </div>
    <!-- الرسائل -->
    @if (session('success'))
    <div class="bg-green-100 border border-green-500 text-green-700 px-4 py-3 rounded mb-4">
         {{ session('success') }} 
    </div>    
    @endif
    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200" >
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-4 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">#</th>
                    <th class="px-6 py-4 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">اسم المجموعة</th>
                    <th class="px-6 py-4 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">المشرف</th>
                    <th class="px-6 py-4 text-right text-xs font-medium text-gray-500 uppercase tracking-wider"> الاجراءات</th>
                </tr>
            </thead>
            <tbody class="min-w-full divide-y divide-gray-200">
                @foreach ($groups as $group )
                @php
                $leader = $group->leader;
                @endphp
                <hr><hr>
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500" >{{$loop->iteration}}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-medium text-gray-500" >{{$group->name}}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500" >{{ $leader->name }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-medium" >
                    <a href="{{route('groups.edit', $group->id)}}" class="text-yellow-500 hover:text-yellow-900">
                        تعديل </a>
                    </td>
                    <td>
                      @livewire('delete-group', ['groupId' => $group->id], key('delete-'.$group->id))
                    </td>
                    <td>
                        <a href="{{ route('groups.show', $group->id) }}" 
                            class="text-blue-500 hover:text-blue-900">
                            <i class="far fa-eye"></i> عرض</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="mt-4">
        {{$groups->links()}}
    </div>
    @else
    <div class="alert alert-inf">لا توجد مجموعات متاحة</div>
    @endif
    @livewireScripts
</div>
@endsection