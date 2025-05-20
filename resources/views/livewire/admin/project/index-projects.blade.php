<div class="container mx-auto px-4">
    <h1 class="text-2xl font-bold mb-6 text-right">المشاريع</h1>
    <a href="{{ route('projects.create') }}" class="bg-blue-500 text-white px-4 py-2  rounded-lg transition duration-200">إنشاء مشروع</a>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
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