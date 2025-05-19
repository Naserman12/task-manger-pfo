<div class="container mx-auto p-6">
       {{-- The Master doesn't talk, he acts. --}}
    @if(session()->has('message'))
        <div class="alert alert-success bg-blue-500 text-white p-4 rounded-md mb-4">
            {{ session('message') }}
        </div>
    @endif
    <a href="{{ route('groups.index') }}" class="bg-blue-500 text-white px-6 py-3 rounded-lg transition duration-200 mb-6 inline-block">
        عرض المجموعات
    </a>
    <form wire:submit.prevent="saveGroup" class="bg-white p-6 rounded-lg shadow-md space-y-4">
        <div class="form-group">
            <label for="GroupName" class="text-lg font-semibold">اسم المجموعة</label>
            <input name="name" id="GroupName" type="text" wire:model.defer="name" required
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <label for="LeaderGroutp" class="text-lg font-semibold">مشرف المجموعة</label>
            <select name="leader_id" wire:model.defer="leader_id" required
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                <option value="">اختر مشرف</option>
                @foreach ($users as  $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
            @error('leader_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="flex space-x-4">
            <button type="submit"
                class="bg-blue-500 text-white px-6 py-3 rounded-lg transition duration-200 w-full md:w-auto">
                {{$isEdit ?  'تعديل المجموعة' : 'إضافة مجموعة' }}
            </button>

            @if ($isEdit)
                <button type="button" wire:click="resetForm"
                    class="bg-gray-300 text-black px-6 py-3 rounded-lg transition duration-200 w-full md:w-auto">
                    إلغاء التعديل
                </button>
            @endif
        </div>
    </form>

    <hr class="my-6">

    <h2 class="text-2xl font-semibold mb-4">المجموعات الحالية</h2>
    <div class="overflow-x-auto">
        <table class="min-w-full table-auto bg-white shadow-md rounded-lg">
            <thead class="bg-blue-500 text-white">
                <tr>
                    <th class="py-2 px-4 text-center">اسم المجموعة</th>
                    <th class="py-2 px-4 text-center">مشرف المجموعة</th>
                    @if (!$isEdit)
                        <th class="py-2 px-4 text-center">الإجراءات</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @foreach ($groups as $group)
                    @if ($group)
                        <tr class="border-b">
                            <td class="py-2 px-4 text-center">{{ $group->name }}</td>
                            <td class="py-2 px-4 text-center">{{ $group->leader->name }}</td>
                            @if (!$isEdit)
                                <td class="py-2 px-4 text-center">
                                    <a href="{{ route('groups.edit', $group->id) }}"
                                        class="text-blue-500 hover:text-blue-700">تعديل 📝</a>
                                </td>
                            @endif
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
    </div>
</div>
