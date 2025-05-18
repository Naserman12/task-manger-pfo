<div> 
<div x-data="{ dropdownOpen: false, sidebarOpen: false, showNavbar: true }">
    <!-- زر إظهار/إخفاء النافبار -->
    <div class="fixed right-2 z-50" :class="{ 'top-14': showNavbar, 'top-2': !showNavbar }">
        <button 
            @click="showNavbar = !showNavbar"
            class=" text-white p-1 rounded-full shadow-md bg-blue-100 border-blue-700  hover:bg-blue-400 transition-all duration-300 text-sm"
            aria-label="Toggle Navbar"
        >
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path :d="showNavbar ? 'M19 9l-7 7-7-7' : 'M5 15l7-7 7 7'" />
            </svg>
        </button>
    </div>
    <!-- مثال: إظهار/إخفاء النافبار -->
    <nav x-show="showNavbar" class="bg-blue-600 text-white shadow-md fixed w-full z-50 transition-all duration-300"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 -translate-y-full"
        x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-300"
        x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 -translate-y-full"
     >
        <!-- محتوى النافبار هنا -->
        <div class="max-w-7xl mx-auto px-4 py-3  z-[999] flex flex-row-reverse items-center justify-between relative">
            <!-- شعار النظام -->
            <div class="text-2xl font-bold"> إدارة المهام</div>

            <!-- روابط -->
            @auth
            <div class="flex items-center gap-4">
                @livewire('notifications-list')
                @livewire('groups.member-btn')
            @endauth

            <div class="relative">
                <button @click="dropdownOpen = !dropdownOpen"
                    class="text-white font-semibold text-sm hover:text-blue-200">
                    الصفحة 
                    @if (View::hasSection('pageTitle'))
                    <span class="text-sm text-blue-200">/ @yield('pageTitle')</span>
                    @endif
                </button>

                <div x-show="dropdownOpen" @click.away="dropdownOpen = false" x-transition
                class="absolute right-0 mt-2 w-48 bg-blue-700 rounded-md shadow-lg z-50 py-2 text-right">
                <a href="{{ route('/') }}#home" class="block px-4 py-2 hover:bg-blue-600">الرئيسية</a>
                    <a href="{{ route('groups.index') }}#about-project" class="block px-4 py-2 hover:bg-blue-600">المجموعات</a>
                    <a href="{{ route('/') }}#about-dev" class="block px-4 py-2 hover:bg-blue-600">عن المطور</a>
                    <a href="{{ route('/') }}#tools" class="block px-4 py-2 hover:bg-blue-600">الأدوات</a>
                    <a href="{{ route('/') }}#skills" class="block px-4 py-2 hover:bg-blue-600">المهارات</a>
                    @auth
                    <a href="{{ route('dashboard') }}" class="block px-4 py-2 hover:bg-blue-600">لوحة التحكم</a>
                    @endauth
                </div>    
            </div>
            
            <div class="hidden sm:flex text-white">
                <x-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')">
                    {{ __('لوحة التحكم') }}
                </x-nav-link>
            </div>
        
            <div class="hidden sm:flex text-white">
                <x-nav-link :href="route('admin.groups')" :active="request()->routeIs('admin.groups')">
                    {{ __('عرض المجموعات') }}
                </x-nav-link>
            </div>
            <div class="hidden sm:flex text-white">
                <x-nav-link :href="route('admin.projects.index')" :active="request()->routeIs('admin.projects.index')">
                    {{ __('عرض المشاريع') }}
                </x-nav-link>
            </div>
            <div class="hidden sm:flex text-white">
                <x-nav-link :href="route('admin.projects.index')" :active="request()->routeIs('admin.projects.index')">
                    {{ __('عرض المشاريع') }}
                </x-nav-link>
            </div>
        </div>
    </nav>
</div>
</div>
