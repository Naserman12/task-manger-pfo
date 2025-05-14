
<!-- فكرة  -->
<div x-data="{ open: false, notifications: [{id: 1, message: 'لديك مهمة جديدة!'}] }" class="relative">

  <!-- زر الجرس -->
  <button @click="open = !open" class="relative p-2 focus:outline-none">
    <svg class="w-6 h-6 text-yellow-500" fill="currentColor" viewBox="0 0 20 20">
      <path d="M10 2a6 6 0 00-6 6v2.586l-.707.707A1 1 0 004 13h12a1 1 0 00.707-1.707L16 10.586V8a6 6 0 00-6-6zM10 18a2 2 0 002-2H8a2 2 0 002 2z" />
    </svg>

    <!-- عدد الإشعارات -->
    <template x-if="notifications.length > 0">
      <span class="absolute -top-1 -right-1 bg-red-600 text-white text-xs font-bold rounded-full w-5 h-5 flex items-center justify-center">
        <span x-text="notifications.length">{{ $unreadCount }}</span>
      </span>
    </template>
  </button>

  <!-- قائمة الإشعارات -->
  <div 
    x-show="open"
    x-cloak
    x-transition
    class="fixed bottom-0 left-0 right-0 z-50 bg-white shadow-lg rounded-t-lg 
           max-h-[60vh] overflow-y-auto px-4 py-3 sm:absolute sm:top-10 sm:right-0 sm:left-auto sm:w-80 sm:rounded-md sm:max-h-96"
    @click.away="open = false"
  >

    <h3 class="font-bold mb-2">🔔الإشعارات</h3>

    <template x-if="notifications.length === 0">
      <p class="text-sm text-gray-500">لا توجد إشعارات غير مقروءة</p>
    </template>

    <template x-for="notification in notifications" :key="notification.id">
      <div class="p-2 border-b text-sm">
        <p x-text="notification.message"></p>
      </div>
    </template>

    <button class="mt-2 text-blue-600 underline w-full text-center">عرض كل الإشعارات</button>
  </div>
</div>
