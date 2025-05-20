<!-- زر المستخدم بجانب زر الإشعارات -->
<div class="relative" x-data="{ userMenuOpen: false }">
    <button @click="userMenuOpen = !userMenuOpen" class="flex items-center gap-2 hover:text-blue-200">
        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" stroke-width="2"
            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round"
                d="M5.121 17.804A4 4 0 018 16h8a4 4 0 012.879 1.804M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
        </svg>
    </button>
    <!-- القائمة المنسدلة -->
    <div x-show="userMenuOpen" @click.away="userMenuOpen = false" x-transition
         class="absolute right-0 mt-2 w-48 bg-white text-gray-800 rounded-md shadow-lg z-50 py-2 text-right">
        <div class="px-4 py-2 font-semibold border-b border-gray-200">
            {{ Auth::user()->name }}
        </div>
        <a href="{{ route('show-profile', auth()->user()->id) }}" class="block px-4 py-2 hover:bg-gray-100">الملف الشخصي</a>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit"
                class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150">
                تسجيل الخروج
            </button>
        </form>
    </div>
</div>
