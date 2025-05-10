<div x-data="{open: false}"
        @click.away="open = false"
       
        wiree:wire:poll.60s="undateCount" >
    <div class="bottom-2 rghit-4 z-[5555] container relative group ">
        <!-- زر الإشعارات -->
         <button
         @click="open = !open" class="p-2 bg-white hover:bg-gray-200 relative" title="الإشعارات"
         wire:click="toggleDropdown">
         <svg class="flex w-6 h-6  " fill="none" stroke="currentColor" viewBox="0 0 24 24 hover:bg-indigo-600 "></svg>
    
         <span class=" top-0 rghit-0 bg-red-400 text-white text-sm rounded-full h-5 w-5 flex items-center justify-center">
            {{ $unreadCount }}
         </span>
        </button>
        </div>
        <!-- قائمة الإشعارات -->
        <div 
        x-show="open"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 scale-95"
        x-transition:enter-end="opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100 scale-100"
        x-transition:leave-end=" opacity-0 scale-95 "
        class=" rghit-0 ml-3 mt-2 w-80 bottom-full bg-white rounded-md shadow-lg z-50 border border-gray-200"
        >
        <div  class="p-4 border-b border-gray-200 flex justify-between items-center">
            <h3 class="font-bold text-gray-800 text-sm hover:underline"> <i class="fas fa-bell me-2" ></i>  الإشعارات </h3>
            @if ($unreadCount > 0)
             <button wire:click="markAllAsRead" class="text-sm text-blue-600 hover:underline">
                تعيين الكل كمقروء
             </button>
             @endif
         </div>
        <div class="max-h-96 overflow-y-auto card-body p-0"> 
            @forelse (auth()->user()->unreadNotifications as $notification)
            <p>ID: {{ $notification->id }}</p>
            <div 
            wire:key="notification-{{ $notification->id }}"
            class="  p-4 border-b border-gray-100 hover:bg-gray-50 transition cursor-pointer flex items-start"
            wire:click="markAsRead('{{ $notification->id }}')">
            <div class=" bg-blue-100 p-2 rounded-full mr-3 flex-shirnk-0  ">
                <svg class="w-5 h-5 text-blue-600" fill="none" stroke=" currentColor "> 
                    <path></path>
                </svg>
            </div>
            <div class="flex-1">
              
                <p class="text-gray-800 font-medium">{{ $notification->data['message'] }}</p>
                @error('notifications')
                <span class="text-red-500 text-sm" >{{ $message }}</span>
                @enderror
                <div class="flex justify-between items-center mt-1">
                    
                    <a href="{{ $notification->data['url'] ?? '#' }}"
                    class=" text-blue-600 text-sm hover:underline"
                    @click.stop
                    >عرض</a>
                </div>
            </div>
        </div>
        @empty
        <div class=" p-8 text-center text-gray-500">
            لا توجد إشعارات غير مقروءة
        </div>
        @error('unreadNotifications')
        <span class="text-red-500 text-sm ">{{ $message }}</span>
        @enderror
            @endforelse  
        </div>
    </div>
</div>
