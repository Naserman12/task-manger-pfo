<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>لوحة تحكم admin المدير</title>
    @livewireStyles
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body   x-data="{ sidebarOpen: false }" class="bg-gray-100 font-sans relative">

      @livewire('navbar')
      <!-- يظهر فقط في الشاشات الصغيرة -->
    <button @click="sidebarOpen = !sidebarOpen"
        class="md:hidden fixed top-16 right-1 z-50 p-2 text-blue-700   hover:bg-blue-100 rounded-full shadow">
        ☰
    </button>
          <div class="flex flex-row-reverse min-h-screen pt-20"> 
              <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif
    <!-- Sidebar ثابتة على اليمين -->
    <aside class="w-64 bg-gray-800 text-white fixed right-0 top-0 h-full p-4 hidden md:block"
     :class="{ 'block': sidebarOpen, 'hidden': !sidebarOpen }"
     x-show="sidebarOpen  || window.innerWidth >= 768"
    x-transition:enter="transition transform duration-300"
    x-transition:enter-start="translate-x-full"
    x-transition:enter-end="translate-x-0"
    x-transition:leave="transition transform duration-300"
    x-transition:leave-start="translate-x-0"
    x-transition:leave-end="translate-x-full"
     @click.away="sidebarOpen = false">
        <div class="text-2xl font-bold mb-8 text-center">لوحة التحكم</div>
        <nav class="flex-1">
            <ul class="space-y-2">
                <li><a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 hover:bg-gray-700 rounded">الصفحة الرئيسية</a></li>
                <li><a href="{{ route('admin.groups') }}" class="block px-4 py-2 hover:bg-gray-700 rounded">المجموعات</a></li>
                <li><a href="{{ route('admin.projects.index') }}" class="block px-4 py-2 hover:bg-gray-700 rounded">المشاريع</a></li>
                <li><a href="{{ route('admin.users') }}" class="block px-4 py-2 hover:bg-gray-700 rounded">المستخدمين</a></li>
                <li><a href="{{ route('admin.reports') }}" class="block px-4 py-2 hover:bg-gray-700 rounded">التقارير</a></li>
                <li><a href="{{ route('groups.create') }}" class="block px-4 py-2 hover:bg-gray-700 rounded">إنشاء مجموعة</a></li>
                <li><a href="{{ route('/') }}" class="block px-4 py-2 hover:bg-gray-700 rounded">واجهة المستخدمين</a></li>
            </ul>
        </nav>
        <div class="mt-auto">
            <a href="#" class="block px-4 py-2 hover:bg-red-700 bg-red-600 rounded text-center">تسجيل الخروج</a>
        </div>
    </aside>
    <!-- Main content with padding to avoid overlapping sidebar -->
    <main class="p-6 flex justify-center items-center min-h-screen md:block md:pr-64">
        @yield('admin-content')
    </main>
    </div>
    @livewireScripts
</body>
</html>
