<div>
    {{-- The Master doesn't talk, he acts. --}}
    <div class="p-4">

    @if (session()->has('message'))
        <div class="bg-green-200 text-green-800 p-2 rounded mb-4">
            {{ session('message') }}
        </div>
    @endif

    <h2 class="text-xl font-bold mb-4">طلبات تنفيذ المهام المعلقة</h2>

    @if($taskRequests->isEmpty())
        <p>لا توجد طلبات معلقة.</p>
    @else
        <table class="min-w-full bg-white border">
            <thead>
                <tr>
                    <th class="border px-4 py-2">المهمة</th>
                    <th class="border px-4 py-2">المستخدم</th>
                    <th class="border px-4 py-2">التاريخ</th>
                    <th class="border px-4 py-2">الإجراءات</th>
                </tr>
            </thead>
            <tbody>
                @foreach($taskRequests as $request)
                    <tr>
                        <td class="border px-4 py-2">{{ $request->task->title ?? 'مهمة محذوفة' }}</td>
                        <td class="border px-4 py-2">{{ $request->user->name ?? 'مستخدم محذوف' }}</td>
                        <td class="border px-4 py-2">{{ $request->created_at->format('Y-m-d') }}</td>
                        <td class="border px-4 py-2 space-x-2">

                            <button wire:click="approve({{ $request->id }})" 
                                class="bg-green-500 text-white px-3 py-1 rounded hover:bg-green-600">
                                قبول
                            </button>

                            <button wire:click="confirmReject({{ $request->id }})" 
                                class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">
                                رفض
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    {{-- نافذة رفض الطلب --}}
    @if($rejectingRequestId)
        <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center">
            <div class="bg-white p-6 rounded shadow-lg w-96">
                <h3 class="text-lg font-bold mb-4">سبب رفض الطلب</h3>
                <textarea wire:model="rejectionNote" rows="4" class="w-full border rounded p-2"></textarea>

                <div class="mt-4 flex justify-end space-x-2">
                    <button wire:click="$set('rejectingRequestId', null)" 
                        class="px-4 py-2 border rounded hover:bg-gray-100">
                        إلغاء
                    </button>
                    <button wire:click="reject()" 
                        class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600">
                        رفض الطلب
                    </button>
                </div>
            </div>
        </div>
    @endif

</div>

</div>
