@extends('layouts.admin')

@section('admin-content')
<div class="container mx-auto p-4">
    <h2 class="text-2xl font-semibold mb-4">📝 تعديل المهمة</h2>

    <form method="POST" action="{{ route('tasks.update', $task->id) }}" class="bg-white shadow-md rounded px-8 pt-6 pb-8">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label class="block text-gray-700">العنوان</label>
            <input type="text" name="title" value="{{ old('title', $task->title) }}" required
                   class="w-full border-gray-300 rounded mt-1">
        </div>

        <div class="mb-4">
            <label class="block text-gray-700">الوصف</label>
            <textarea name="description" class="w-full border-gray-300 rounded mt-1">{{ old('description', $task->description) }}</textarea>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700">الحالة</label>
            <select name="status" class="w-full border-gray-300 rounded mt-1">
                <option value="pending" @selected($task->status === 'pending')>قيد الانتظار</option>
                <option value="in_progress" @selected($task->status === 'in_progress')>قيد التنفيذ</option>
                <option value="completed" @selected($task->status === 'done')>منجزة</option>
                <option value="available" @selected($task->status === 'done')>متاحة  للاعضاء</option>
            </select>
        </div>

        <div>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">💾 حفظ التعديلات</button>
        </div>
    </form>
</div>
@endsection
