<div>

<!-- زر الإشعارات -->
<div x-data="{ open: false }"
     @click.away="open = false"
     wire:poll.60s="unreadCount"
     class="relative">
    
    <!-- زر الجرس -->
    <button @click="open = !open"
        wire:click="toggleDropdown"
        class="relative p-2 bg-white text-black rounded-full hover:bg-gray-200 transition"
        title="الإشعارات">
        🔔
        <span class="absolute -top-1 -right-1 bg-red-500 text-white text-xs font-bold rounded-full h-5 w-5 flex items-center justify-center">
            {{ $unreadCount }}
        </span>
    </button>

    <!-- قائمة الإشعارات -->
    <div x-show="open"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 scale-95"
         x-transition:enter-end="opacity-100 scale-100"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100 scale-100"
         x-transition:leave-end="opacity-0 scale-95"
         class="absolute right-0 md:right-0 md:left-auto md:translate-x-0 
           left-1/2 -translate-x-1/2 mt-2 w-80 bg-white shadow-lg rounded-md z-50"
         style="max-height: 400px; overflow-y: auto;"
         >
        <!-- رأس القائمة -->
        <div class="p-4 border-b border-gray-200 flex justify-between items-center">
            <h3 class="font-bold text-gray-800 text-sm">🔔 الإشعارات</h3>
            @if ($unreadCount > 0)
                <button wire:click="markAllAsRead" class="text-sm text-blue-600 hover:underline">
                    تعيين الكل كمقروء
                </button>
            @endif
            </div>

        <!-- محتوى الإشعارات -->
        <div class="p-0">
            @forelse (auth()->user()->unreadNotifications as $notification)
            <div wire:key="notification-{{ $notification->id }}"
                wire:click="markAsRead('{{ $notification->id }}')"
                    class="p-4 border-b border-gray-100 hover:bg-gray-50 cursor-pointer flex items-start">
                    
                    <div class="bg-blue-100 p-2 rounded-full mr-3">
                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor">
                            <path d="M12 22s8-4 8-10V6a8 8 0 10-16 0v6c0 6 8 10 8 10z" />
                        </svg>
                    </div>

                    <div class="flex-1">
                        <p class="text-gray-800 font-medium">{{ $notification->data['message'] }}</p>
                        <div class="flex justify-between items-center mt-1">
                            <a href="{{ route('notifications.show', $notification->id) }}"
                               class="text-blue-600 text-sm hover:underline"
                               @click.stop>عرض</a>

                               
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="p-6 text-center text-gray-500">لا توجد إشعارات غير مقروءة</div>
                    @endforelse
                    <a href="{{ route('notifications.index') }}" class="text-blue-500 hover:underline">عرض الإشعارات</a>
        </div>
    </div>
</div>
</div>