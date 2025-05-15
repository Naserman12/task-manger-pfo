<div>
    <div x-data="{ dropdownOpen: false, sidebarOpen: false }">
        <!-- Navbar -->
        <nav class="bg-blue-600 text-white shadow-md fixed w-full z-50">
            <div class="max-w-7xl mx-auto px-4 py-3 flex flex-row-reverse items-center justify-between relative">
            <!-- شعار النظام -->
            <div class="text-2xl font-bold"> إدارة المهام</div>

            <!-- روابط -->
            @auth
            <div class="flex items-center gap-4">
                <!-- زر الإشعارات -->
                    @livewire('notifications-list')
                    <!-- زر بيانات المستخدم -->
                     @livewire('groups.member-btn')
                @endauth
                <!-- الصفحة الرئيسية مع قائمة منسدلة -->
                <div class="relative">
                    <button @click="dropdownOpen = !dropdownOpen"
                        class="text-white font-semibold text-sm hover:text-blue-200">
                        الصفحة 
                        @if (View::hasSection('pageTitle'))
                        <span class="text-sm text-blue-200">/ @yield('pageTitle')</span>
                         @endif
                    </button>
                    <!-- القائمة المنسدلة -->
                    @auth
                    <div x-show="dropdownOpen" @click.away="dropdownOpen = false" x-transition
                        class="absolute right-0 mt-2 w-48 bg-blue-700 rounded-md shadow-lg z-50 py-2 text-right">
                        <a href="{{ route('/') }}#home" class="block px-4 py-2 hover:bg-blue-600">الرئيسية</a>
                        <a href="{{ route('groups.index') }}#about-project" class="block px-4 py-2 hover:bg-blue-600" >المجموعات</a>
                        <a href="{{ route('/') }}#about-dev" class="block px-4 py-2 hover:bg-blue-600">عن المطور</a>
                        <a href="{{ route('/') }}#tools" class="block px-4 py-2 hover:bg-blue-600">الأدوات</a>
                        <a href="{{ route('/') }}#skills" class="block px-4 py-2 hover:bg-blue-600">المهارات</a>
                        @auth
                            <a href="{{ route('dashboard') }}" class="block px-4 py-2 hover:bg-blue-600">لوحة التحكم</a>
                        @else
                            <a href="{{ route('login') }}" class="block px-4 py-2 hover:bg-blue-600">تسجيل الدخول</a>
                        @endauth
                    </div>    
                </div>
                @if (Auth()->user()->role === 'admin')
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex text-white">
                    <x-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('dashboard')" wire:navigate>
                        {{ __('لوحة التحكم') }}
                    </x-nav-link>
                </div>
                @endif
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex text-white">
                    <x-nav-link :href="route('groups.index')" :active="request()->routeIs('groups.index')" wire:navigate>
                        {{ __(' عرض  المجموعات') }}
                    </x-nav-link>
                </div>
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex text-white ">
                    <x-nav-link :href="route('groups.index')" :active="request()->routeIs('groups.index')" wire:navigate>
                        {{ __(' عرض  المهام') }}
                    </x-nav-link>
                </div>
                <!-- زر القائمة الجانبية للجوال -->
                <!-- <button @click="sidebarOpen = !sidebarOpen" class="md:hidden text-white text-2xl ">&#9776;</button> -->
            </div>
        </div>
        <!-- الشريط الجانبي للجوال -->
        <div x-show="sidebarOpen" @click.away="sidebarOpen = false" x-transition
            class="fixed top-0 right-0 h-full w-64 bg-blue-700 text-white px-6 py-6 space-y-3 text-right z-50 md:hidden shadow-lg">
                <a href="{{ route('dashboard') }}" class="block hover:text-blue-300">لوحة التحكم</a>
                <a href="{{ route('logout') }}" class="block hover:text-blue-300">تسجيل الخروج</a>
            @else
                <a href="{{ route('login') }}" class="block hover:text-blue-300">تسجيل الدخول</a>
            @endauth
        </div>
    </nav>
</div>
</div>