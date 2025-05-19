<div>
    <!-- Be present above all else. - Naval Ravikant -->
     <div dir="rtl" class="max-w-2xl mx-auto p-6 bg-white shadow-md rounded-lg mt-6 space-y-6">
 
    <h2 class="text-2xl font-bold text-gray-800 mb-4">👤 الملف الشخصي: {{ $user->name }}</h2>

    <div class="flex flex-col items-center gap-4">
        <img src="{{ $user->image_url ?? 'https://via.placeholder.com/120' }}"
             alt="صورة المستخدم"
             class="w-28 h-28 rounded-full border border-gray-300 object-cover">

        <div class="text-center space-y-1">
            <p>📧 {{ $user->email }}</p>
            <p>📞 {{ $user->phone ?? 'غير متوفر' }}</p>
            <p>🏢 {{ $user->role }} - {{ $user->department}}</p>
        </div>
    </div>

    <hr class="border-gray-300">

    <div class="space-y-2 text-sm text-gray-700">
        @if ($user->created_at)
        <p>📅 <span class="font-semibold">تاريخ التسجيل:</span> {{ $user->created_at->format('d/m/Y') ?? "" }}</p>
        @endif
        <p>✅ <span class="font-semibold">الحالة:</span>
            @if($user->is_active)
                <span class="text-green-600 font-bold">نشط</span>
            @else
                <span class="text-red-600 font-bold">غير نشط</span>
            @endif
        </p>
    </div>
    @if(auth()->id() === $user->id)
        <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-blue">تعديل الحساب</a>
    @endif
    <!-- chinge role -->
    @if(auth()->user()->role === 'admin')
    <form action="{{ route('admin.users.updateRole', $user->id) }}" method="POST" class="mt-6 max-w-md space-y-4 p-4 bg-white shadow rounded-lg border">
        @csrf
            @method('PATCH')

            <h3 class="text-lg font-bold text-gray-800">🛠️ تعديل دور المستخدم</h3>

            <div>
                <label for="role" class="block mb-1 font-medium text-gray-700">الدور</label>
                <select id="role" name="role" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200">
                    <option value="member" @selected($user->role === 'member')>مستخدم</option>
                    <option value="leader" @selected($user->role === 'leader')>مدير مجموعة</option>
                    <option value="admin" @selected($user->role === 'admin')>مدير عام</option>
                </select>
            </div>
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md transition">
                💾 حفظ التغيير
            </button>
        </form>
        @endif
        <!-- chinge role -->

    <!-- حذف المستخدم من قبل المدير -->
    @if(Auth::user()->role === 'admin' && Auth::id() !== $user->id)
    <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('هل تريد حذف هذا المستخدم نهائيًا؟')">
        @csrf
        @method('DELETE')
        <button type="submit" class="text-red-600 hover:underline">🗑️ حذف نهائي</button>
    </form>
    @endif
    <!--// هذف المستخدم من قبل المدير //-->

    <hr class="border-gray-300">

    <div class="text-sm text-gray-700">
        <p class="font-semibold mb-2">📊 الإحصائيات:</p>
        <ul class="list-disc pl-5 space-y-1">
            <li>{{ $user->projects_count ?? 0 }} مشروع منجز</li>
            <li>{{ $user->tasks_count ?? 0 }} مهمة مكتملة</li>
        </ul>
    </div>

</div>

</div>