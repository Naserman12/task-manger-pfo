<div>
    {{-- Stop trying to control. --}}
    <div class="max-w-4xl mx-auto p-6 bg-white rounded-lg shadow-lg mt-8">

    <h1 class="text-2xl font-bold mb-6 text-gray-800">📋 قائمة المهام (للمشرف)</h1>

    {{-- بحث وتصفية --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6 gap-4">
        <input type="text" placeholder="بحث عن مهمة أو مكلف..." wire:model.debounce.500ms="search" class="w-full sm:w-2/3 px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" />

        <select wire:model.debounce.500ms="statusFilter" class="w-full sm:w-1/3 px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
            <option value="">تصفية حسب الحالة</option>
            <option value="completed">✅ مكتملة</option>
            <option value="under_review">⏳ قيد المراجعة</option>
            <option value="in_progress">🚧 قيد التنفيذ</option>
            <option value="pending">🕓 بانتظار القبول</option>
            <option value="available">🕓 متاحة للاعضاء </option>
        </select>
    </div>

    {{-- قائمة المهام --}}
    <div class="space-y-4">
        @forelse ($tasks as $task)
            <div class="p-4 border rounded-lg shadow-sm hover:shadow-md transition">
                <h2 class="text-lg font-semibold text-gray-900 mb-1">📝 المهمة: {{ $task->title }}</h2>
                <p class="text-gray-700 mb-1"><strong>👤 المكلف:</strong> {{ optional($task->assignedUser)->name ?? 'غير محدد' }}</p>
                <p class="text-gray-700 mb-2"><strong>📅 تاريخ التسليم:</strong> {{ $task->due_at }}</p>
                <p class="mb-3">
                    @switch($task->status)
                        @case('completed')
                            <span class="inline-block bg-green-200 text-green-800 px-3 py-1 rounded-full text-sm font-semibold">✅ مكتملة</span>
                            @break
                        @case('under_review')
                            <span class="inline-block bg-indigo-200 text-indigo-800 px-3 py-1 rounded-full text-sm font-semibold">⏳ قيد المراجعة</span>
                            @break
                        @case('in_progress')
                            <span class="inline-block bg-yellow-200 text-yellow-800 px-3 py-1 rounded-full text-sm font-semibold">🚧 قيد التنفيذ</span>
                            @break
                        @case('pending')
                            <span class="inline-block bg-gray-200 text-gray-800 px-3 py-1 rounded-full text-sm font-semibold">🕓 بانتظار القبول</span>
                            @break
                        @case('available')
                            <span class="inline-block bg-gray-200 text-gray-800 px-3 py-1 rounded-full text-sm font-semibold">🕓  متاحة للاعضاء</span>
                            @break
                    @endswitch
                </p>

                <div class="flex gap-3">
                    <button onclick="window.location='{{ route('tasks.show', $task->id)}}'" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition">عرض التفاصيل</button>
                    {{-- أزرار تعديل الحالة حسب الصلاحيات والحالة --}}
                    @if (auth()->user()->role === 'sub_leader' || auth()->user()->role === 'admin')
                    <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" onsubmit="return confirm('هل أنت متأكد من حذف هذه المهمة؟');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600 transition">
                            🗑️ حذف
                        </button>
                    </form>     
                    @endif
                </div>
            </div>
        @empty
            <p class="text-center text-gray-500">لا توجد مهام للعرض.</p>
        @endforelse
    </div>

    {{-- زر إضافة مهمة --}}
    <div class="mt-6">
        <button wire:click="$emit('createTask')" class="w-full bg-purple-600 text-white py-3 rounded hover:bg-purple-700 transition font-semibold text-lg">
            ➕ إنشاء مهمة جديدة
        </button>
    </div>

</div>

</div>
