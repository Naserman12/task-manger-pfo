@extends('layouts.admin') {{-- استخدم تخطيط لوحة التحكم --}}
@section('admin-content')
<div>
    <div class="container max-auto px-4 py-8">  
            <div class="felx justify-between items-center bm-8">
                <h1 class="text-3xl font-bild mb-4 text-gray-800">المشاريع</h1>
                <a href="{{ route('projects.create', ['project_id' => null]) }}" class="bg-blue-500 text-white px-4 py-2  rounded-lg transition duration-200">إضافة مشروع</a><br><hr>
            </div>
        </div>
     <!-- الرسائل -->
    @if (session('success'))
    <div class="bg-green-100 border border-green-500 text-green-700 px-4 py-3 rounded mb-4">
         {{ session('success') }} 
    </div>    
    @endif
<div class="container mx-auto px-4">                 
    <div class="grid grid-cols-1  sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse ($projects as $project)
            <div class="bg-white rounded-lg shadow p-4 flex flex-col justify-between hover:shadow-md transition duration-300">
                <div>
                    <h2 class="text-xl font-semibold mb-2">{{ $project->name }}</h2>
                    <p class="text-gray-600 text-sm mb-4 line-clamp-3">{{ $project->description }}</p>
                </div>
                <div class="text-sm text-gray-500 mt-auto">
                    <p><strong>المجموعة:</strong> {{ $project->group->name ?? 'غير محددة' }}</p>
                    <p><strong>تاريخ الإنشاء:</strong> {{ $project->created_at->format('Y-m-d') }}</p>
                </div>
                <a href="{{ route('admin.project.show', $project->id) }}"
                   class="mt-4 inline-block bg-blue-600 hover:bg-blue-700 text-white text-center py-1.5 rounded transition-all">
                    عرض التفاصيل
                </a>
            </div>
        @empty
            <div class="col-span-full text-center text-gray-500">لا توجد مشاريع حالياً.</div>
        @endforelse
    </div>
</div>
</div>
@endsection
