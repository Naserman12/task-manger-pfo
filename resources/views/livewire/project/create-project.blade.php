<div>
    {{-- A good traveler has no fixed plans and is not intent upon arriving. --}}
    
    <div class="max-w-2xl mx-auto p-6 bg-white rounded shadow">
        <h2 class="text-lg font-semibold mb-4">إنشاء مشروع جديد</h2>

        @if (session()->has('success'))
        <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <form wire:submit.prevent="store">
        <div class="mb-4">
            <label>اسم المشروع</label>
            <input type="text" wire:model="name" class="w-full border p-2 rounded" />
            @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label>الوصف</label>
            <textarea wire:model="description" class="w-full border p-2 rounded"></textarea>
            @error('description') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>
        
        <div class="mb-4">
            <label>تاريخ البدء</label>
            <input type="date" wire:model="start_date" class="w-full border p-2 rounded" />
            @error('start_date') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label>تاريخ الانتهاء</label>
            <input type="date" wire:model="end_date" class="w-full border p-2 rounded" />
            @error('end_date') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>
        <div class="mb-4">
    <label>الحالة</label>
    <select wire:model="status" class="w-full border p-2 rounded">
        <option value="pending">قيد الانتظار</option>
        <option value="in_progress">قيد التنفيذ</option>
        <option value="completed">مكتمل</option>
        <option value="cancelled">ملغي</option>
    </select>
    @error('status') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
</div>

<div class="mb-4">
    <label>الأولوية</label>
    <select wire:model="priority" class="w-full border p-2 rounded">
        <option value="low">منخفضة</option>
        <option value="medium">متوسطة</option>
        <option value="high">مرتفعة</option>
    </select>
    @error('priority') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
</div>


        <div class="mb-4">
            <label>المجموعة المسؤولة</label>
            <select wire:model="group_id" class="w-full border p-2 rounded">
                <option value="">اختر مجموعة</option>
                @foreach($groups as $group)
                    <option value="{{ $group->id }}">{{ $group->name }}</option>
                @endforeach
            </select>
            @error('group_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">إنشاء</button>
    </form>
</div>
</div>
