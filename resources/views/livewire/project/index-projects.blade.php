@extends('layouts.admin')
@section('admin-content')

<div>
    {{-- Nothing in the world is as soft and yielding as water. --}}
    <div class="p-4">
    <h2 class="text-xl font-bold mb-4">قائمة المشاريع</h2>
    @if (session()->has('success'))
        <div class="bg-green-100 text-green-800 p-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <table class="w-full border border-gray-200">
        <thead class="bg-gray-100">
            <tr>
                <th class="border px-4 py-2">اسم المشروع</th>
                <th class="border px-4 py-2">المجموعة</th>
                <th class="border px-4 py-2">الأولوية</th>
                <th class="border px-4 py-2">الحالة</th>
                <th class="border px-4 py-2">أنشئ بواسطة</th>
                <th class="border px-4 py-2">المدة</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($projects as $project)
                <tr>
                    <td class="border px-4 py-2">{{ $project->name }}</td>
                    <td class="border px-4 py-2">{{ $project->group->name ?? '—' }}</td>
                    <td class="border px-4 py-2">{{ ucfirst($project->priority) }}</td>
                    <td class="border px-4 py-2">{{ ucfirst($project->status) }}</td>
                    <td class="border px-4 py-2">{{ $project->creator->name ?? '—' }}</td>
                    <td class="border px-4 py-2">{{ $project->start_date }} → {{ $project->end_date }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center py-4 text-gray-500">لا توجد مشاريع حالياً.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

</div>
@endsection
