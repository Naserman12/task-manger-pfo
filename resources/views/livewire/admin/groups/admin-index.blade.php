<div class="px-4 py-8">
    <div class="container mx-auto">
        @if ($groups && $groups->count() > 0)
            <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center mb-8">
                <h1 class="text-2xl sm:text-3xl font-bold mb-4 sm:mb-0 text-gray-800">📋 قائمة المجموعات</h1>
                @if (auth()->user()->role === 'admin' || auth()->user()->role === 'team_leader' )
                <a href="{{ route('groups.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition duration-200 text-center">
                    ➕ إنشاء مجموعة
                </a>
                @endif
            </div>

            @if (session('success'))
                <div class="bg-green-100 border border-green-500 text-green-700 px-4 py-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white shadow-md rounded-lg overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 text-sm text-right">
                    <thead class="bg-gray-100 text-gray-600 uppercase text-xs">
                        <tr>
                            <th class="px-4 py-3">#</th>
                            <th class="px-4 py-3">اسم المجموعة</th>
                            <th class="px-4 py-3">المشرف</th>
                            <th class="px-6 py-4">الإجراءات</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach ($groups as $group)
                            <tr>
                                <td class="px-4 py-3">{{ $loop->iteration }}</td>
                                <td class="px-4 py-3">{{ $group->name }}</td>
                                <td class="px-4 py-3">{{ $group->leader->name }}</td>
                                <td class="px-4 py-3 space-x-2 space-x-reverse">
                                    <a href="{{ route('groups.show', $group->id) }}" class=" hover:underline  text-white px-1 py-1 items-center text-center bg-blue-500 rounded-lg hover:bg-blue-600 ">👁️عرض</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="text-center bg-yellow-100 border border-yellow-400 text-yellow-800 p-4 rounded">
                ⚠️ لا توجد مجموعات متاحة حالياً.
            </div>
        @endif
    </div>
    @livewireScripts
</div>
