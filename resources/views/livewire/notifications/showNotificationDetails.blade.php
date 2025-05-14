@if ($selectedNotification)
    <div class="mt-4 p-4 border bg-gray-100">
        <p><strong>المجموعة:</strong> {{ $notificationDetails['group_name'] }}</p>
        <p><strong>الدعوة من:</strong> {{ $notificationDetails['invited_by'] }}</p>
        <p><strong>تاريخ الإرسال:</strong> {{ $notificationDetails['date'] }}</p>
        <p><strong>الحالة:</strong> {{ $notificationDetails['status'] }}</p>

        <div class="mt-2">
            <button wire:click="acceptInvitationFromNotification" class="bg-green-500 text-white px-3 py-1 rounded">قبول</button>
            <button wire:click="rejectInvitationFromNotification" class="bg-red-500 text-white px-3 py-1 rounded">رفض</button>
        </div>
    </div>
@endif
