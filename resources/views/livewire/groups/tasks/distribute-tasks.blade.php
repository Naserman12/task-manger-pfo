<div>
    {{-- Nothing in the world is as soft and yielding as water. --}}
    <div class="p-4 space-y-4">
    <h1 class="text-2xl font-bold">تقسيم المهام للمشروع: {{ $project->name }}</h1>

    @if (session()->has('success'))
        <div class="bg-green-100 text-green-800 p-2 rounded">
            {{ session('success') }}
        </div>
    @endif

    <form wire:submit.prevent="createTask" class="space-y-4 bg-white p-4 rounded shadow">
        <div>
            <label class="block">عنوان المهمة</label>
            <input wire:model="title" class="w-full border p-2 rounded" />
            @error('title') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block">الوصف</label>
            <textarea wire:model="description" class="w-full border p-2 rounded"></textarea>
        </div>

        <div>
            <label class="block">توكيل إلى عضو (اختياري)</label>
            <select wire:model="assignedTo" class="w-full border p-2 rounded">
                <option value="">-- غير مخصص --</option>
                @foreach($members as $member)
                    <option value="{{ $member->id }}">{{ $member->name }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block">تاريخ التسليم (اختياري)</label>
            <input type="date" wire:model="dueAt" class="w-full border p-2 rounded" />
        </div>

        <button class="bg-blue-500 text-white px-4 py-2 rounded">إضافة المهمة</button>
    </form>

    <hr>

    <h2 class="text-xl font-semibold mt-6">المهام الحالية</h2>
    <ul class="space-y-2">
        @foreach($tasks as $task)
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



</div>
