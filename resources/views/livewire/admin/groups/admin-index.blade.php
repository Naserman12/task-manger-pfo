<div>
    <h3 class="text-xl font-semibold">المجموعات</h3>
    <table class="min-w-full bg-white border border-gray-300">
        <thead>
            <tr>
                <th class="px-4 py-2 text-left">اسم المجموعة</th>
            <th class="px-4 py-2 text-left">عدد الأعضاء</th>
            <th class="px-4 py-2 text-left">الإجراءات</th>
        </tr>
    </thead>
    <tbody>
        @foreach($groups as $group)
            <tr>
                <td class="px-4 py-2">{{ $group->name }}</td>
                <td class="px-4 py-2">{{ $group->members_count }}</td>
                <td class="px-4 py-2">
                    <a href="{{ route('groups.edit', $group->id) }}" class="text-blue-600">تعديل</a>
                 @livewire('delete-group', ['groupId' => $group->id], key('delete-'.$group->id))
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
</div>
