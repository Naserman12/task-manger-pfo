@extends('layouts.admin')
@section('admin-content')
<div class="container mx-auto px-4">
    <div class="bg-white rounded-lg shadow-md p-6 mt-6 max-w-3xl mx-auto">
         <!-- الرسائل -->
        @if (session('success'))
        <div class="bg-green-100 border border-green-500 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }} 
        </div>    
        @endif
                <a href="{{ route('projects.create', ['project_id' => null]) }}" class="bg-blue-500 text-white px-4 py-2  rounded-lg transition duration-200">إضافة مشروع</a>
        <h1 class="text-2xl top-10 font-bold mb-4 text-right"> <strong>تفاصيل المشروع :</strong>{{ $project->name }}</h1>

        <p class="text-gray-700 text-sm mb-4 leading-relaxed text-right">
            <strong>الوصف :</strong>{{ $project->description }}
        </p>

        <div class="text-gray-600 text-sm space-y-2 mb-6 text-right">
            <p><strong>المجموعة:</strong> {{ $project->group->name ?? 'غير محددة' }}</p>
            <p><strong>عدد المهام:</strong> {{ $project->tasks->count() }}</p>
            <p><strong>تاريخ الإنشاء:</strong> {{ $project->created_at->format('Y-m-d') }}</p>
            <p><strong>آخر تحديث:</strong> {{ $project->updated_at->format('Y-m-d') }}</p>
        </div>

        <div class="flex justify-end gap-3">
            <a href="{{ route('projects.edit', $project->id) }}"
               class="bg-yellow-500 hover:bg-yellow-600 text-white py-1.5 px-4 rounded transition-all">
                تعديل 📝
            </a>
            <a href="{{ route('tasks.create', [$project->group->id, $project->id]) }}"
               class=" bg-yellow-900 hover:bg-orange-600 text-white py-1.5 px-4 rounded transition-all">
                إضافة مهام للمشروع 📝
            </a>
            @livewire('admin.project.delete-project', ['projectId' => $project->id], key('delete-'.$project->id))
        </div>
    </div>
       <h2 class="text-xl font-semibold mt-6">المهام الحالية</h2>
        <ul class="space-y-2">   
            @foreach($project->tasks as $task)
            <li class="bg-gray-100 p-3 rounded flex justify-between">
                    <div>
                        <strong>{{ $task->title }}</strong>
                        <p class="text-sm text-gray-600">{{ $task->description }}</p>
                    </div>
                    <span class="text-sm text-gray-700">{{ $task->status }}</span>
                </li>
            @endforeach
        </ul>
</div>
@endsection
