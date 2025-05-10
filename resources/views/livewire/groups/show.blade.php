@extends('layouts.app')
@section('content')
<div class="contauner mx-auto py-8">
    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <div class="bg-blue 600 px-6 py-4">
            <h1 class="text-2x1 font-bold text-white">تفاصيل المجموعة: {{ $group->name }}</h1>
            <div class="flex space-x-4">
                <a href="{{ route('groups.edit', $group->id) }}"
                class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-lg">
                تعديل</a>
                @livewire('delete-group', ['groupId' => $group->id], key('delete-'.$group->id))
            </div>
        </div>
    </div>   
    <!-- الرسائل -->
    @if(session('message'))
    <div class="alert alert-success bg-blue-500">
        {{ session('message') }}
    </div>    
    @endif
    <!-- محتوى الصفحة -->
     <div class="p-6">
        <div class="grid grid-cols-1 md:grip-cols-2 gap-8">
            <!-- معلومات اساسية -->
             <div class="space-y-4">
                <div>
                    <h1 class="text-xl font-semibold text-gray-800">المعلومات الاساسية</h1>
                    <div class="mt-2 space-y-2">
                        <p><span class="font-medium">إسم المجموعة:</span>{{ $group->name }}</p>
                        <P ><span class="font-medium">تاريخ الإنشاء:</span>{{ $group->created_at->format('Y-m-d H:i:s') }}</P>
                    </div>
                </div>
                <!-- المشرف -->
                 <h2 class="text-xl font-semibold text-gray-800">منشئ المجموعة</h2>
                 <div class="mt-2 flex items-center space-x-3">
                    <span>
                        {{ substr($group->leader->name, 0, 1) }}
                    </span>
                 </div>
                 <div>
                    <p class="font-medium">{{ $group->leader->name }}</p>
                    <p class="text-sm text-gray-500 ">{{ $group->leader->email }}</p>
                 </div>
             </div>
        </div>
     </div>
     <!-- الاعضاء -->
      @php
      @endphp
      <div>
        <h2 class="text-xl font-semibold text-gray-800 mb-4">أعضاء المجموعة</h2>
        <div class=" bg-white text-gray-800 p-6 rounded-lg shadow ">
          @livewire('group-members', ['group' => $group], key('member-'.$group->id))
        </div>
      </div>
      <!-- المهام المرتبطة -->
       <div class="mt-8">
        <h2 class="text-xl font-semibold text-gray-800 mt-4">مهام المجموعة</h2>
        <div class="bg-gray-50 p-4 rounded-lg" >
            
        </div>
       </div>
</div>
@endsection