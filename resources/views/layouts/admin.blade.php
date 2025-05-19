<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>لوحة تحكم admin المدير</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body   x-data="{ sidebarOpen: false }" class="bg-gradient-to-r  from-blue-800 to-cyan-400 font-sans relative">
      @include('livewire.navbar')
      <!-- يظهر فقط في الشاشات الصغيرة -->
       <div class="">
      
    <button @click="sidebarOpen = !sidebarOpen"
        class="md:hidden  fixed top-20 right-1 z-50 p-2 text-blue-700   hover:bg-blue-100 rounded-full shadow">
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
    <aside class="w-64 bg-gradient-to-r from-indigo-900 to-cyan-300  text-white fixed right-0 top-0 h-full p-4 hidden md:block"
     :class="{ 'block': sidebarOpen, 'hidden' : !sidebarOpen }"
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
            @auth
            <a href="{{ route('logout') }}" class="block px-4 py-2 hover:bg-red-700 bg-red-600 rounded text-center">تسجيل الخروج</a>
            @else
            <a href="{{ route('login') }}" class="block px-4 py-2 hover:bg-blue-700 bg-blue-600 rounded text-center">تسجيل الدخول</a>
            @endauth
        </div>
                @if (session('message'))
    <div 
        x-data="{ show: true }" 
        x-init="setTimeout(() => show = false, 4000)" 
        x-show="show"
        @click="show = false"
        class="fixed bottom-4 left-4 md:left-1/2 md:-translate-x-1/2 bg-green-100 border border-green-300 text-green-800 px-4 py-3 rounded shadow transition duration-300 ease-in-out z-50"
    >
        {{ session('message') }}
    </div>
@endif
@if (session('error'))
    <div 
        x-data="{ show: true }" 
        x-init="setTimeout(() => show = false, 4000)" 
        x-show="show"
        @click="show = false"
        class="fixed bottom-4 left-4 md:left-1/2 md:-translate-x-1/2 bg-red-100 border border-red-300 text-red-800 px-4 py-3 rounded shadow transition duration-300 ease-in-out z-50"
    >
        {{ session('error') }}
    </div>
@endif
    </aside>
    <!-- Main content with padding to avoid overlapping sidebar -->
    <main class="p-6 flex justify-center items-center min-h-screen md:block md:pr-64">
        @yield('admin-content')
    </main>
    </div>    
       </div>
          <footer class="mt-16 py-6 text-center text-sm text-gray-500 border-t">
            جميع الحقوق محفوظة © {{ date('Y') }} ناصر فلاته
        </footer> 
</body>
</html>
