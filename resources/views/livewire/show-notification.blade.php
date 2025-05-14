<div>
    @if (session()->has('message'))
        <div class="bg-green-100 text-green-800 p-3 rounded mb-4">
            {{ session('message') }}
        </div>
    @endif

    <div class="p-4 bg-white shadow rounded mb-4">
        <h2 class="text-lg font-bold mb-2">نوع الإشعار: {{ $type }}</h2>
        @if ($type === 'GroupInvitationNotification')
            <p><strong>المرسل:</strong> {{ $details['inviter'] ?? 'غير معروف' }}</p>
            <p><strong>الرسالة:</strong> {{ $details['message'] ?? 'لا توجد رسالة' }}</p>
            <p><strong>Id:</strong> {{ $details['group_id'] ?? 'لا توجد رسالة' }}</p>
             @if ($userGroup && $userGroup->pivot->status === 'pending')
             <div class="mt-4 space-x-2">
                 <button wire:click="accept" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded">
                     قبول الدعوة
                 </button>
                 <button wire:click="reject" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded">
                     رفض الدعوة
                 </button>
             </div>
             @elseif($userGroup && $userGroup->pivot->status === 'accepted')
             <div class="mt-4 text-green-600 font-semibold">
                 ✅ تم قبول الدعوة!
                 <a href="{{ route('groups.show',  $details['group_id']) }}" class="underline text-blue-600 ml-2">
                     الذهاب إلى المجموعة
                 </a>
             </div>
         @endif
        @elseif ($type === 'MemberRemovedNotification')
            <p><strong>الموضوع:</strong> {{ $details['actor_name'] ?? 'لا يوجد عنوان' }}</p>
            <p><strong>الإجراء:</strong> {{ $details['action'] ?? 'لا توجد تفاصيل' }}</p>
            <p><strong>الرسالة:</strong> {{ $details['message'] ?? 'لا توجد تفاصيل' }}</p>
        @else
            <p>تفاصيل الإشعار: {{ json_encode($details) }}</p>
        @endif
    </div>
</div>
