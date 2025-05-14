<div>
    <h2 class="text-2xl font-bold mb-4">إشعاراتي</h2>
    <div class="space-y-4">
        @forelse($notifications as $notification)
            <div class="p-4 bg-white shadow rounded-lg">
                <p><strong>الرسالة:</strong> {{ $notification->data['message'] ?? 'لا توجد رسالة' }}</p>
                <p><strong>التاريخ:</strong> {{ $notification->created_at->format('d/m/Y H:i') }}</p>
                
                @if (!$notification->read_at)
                    <span class="text-sm text-red-500">غير مقروء</span>
                @else
                    <span class="text-sm text-green-500">مقروء</span>
                @endif
            </div>
              <a href="{{ route('notifications.show', $notification->id) }}"
                               class="text-blue-600 text-sm hover:underline"
                               @click.stop>عرض</a>
        @empty
            <p class="text-center text-gray-500">لا توجد إشعارات.</p>
        @endforelse
    </div>

    <!-- التصفح -->
    <div class="mt-4">
        {{ $notifications->links() }}
    </div>
</div>
