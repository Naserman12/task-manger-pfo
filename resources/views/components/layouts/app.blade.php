<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>لوحة تحكم المدير</title>
    @livewireStyles
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 font-sans">

    <div class="flex flex-row-reverse h-screen">
        <!-- Sidebar (Right) -->
        <aside class="w-64 bg-gray-800 text-white flex flex-col p-4">
            <div class="text-2xl font-bold mb-8 text-center">لوحة التحكم</div>
            <nav class="flex-1">
                <ul class="space-y-2">
                    <li><a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 hover:bg-gray-700 rounded">الصفحة الرئيسية</a></li>
                    <li><a href="{{ route('admin.groups') }}" class="block px-4 py-2 hover:bg-gray-700 rounded">0المجموعات</a></li>
                    <li><a href="{{ route('admin.projects.create') }}" class="block px-4 py-2 hover:bg-gray-700 rounded">المهام</a></li>
                    <li><a href="{{ route('admin.users') }}" class="block px-4 py-2 hover:bg-gray-700 rounded">المستخدمين</a></li>
                    <li><a href="{{ route('admin.reports') }}" class="block px-4 py-2 hover:bg-gray-700 rounded">التقارير</a></li>
                    <li><a href="{{ route('admin.settings') }}" class="block px-4 py-2 hover:bg-gray-700 rounded">الإعدادات</a></li>
                </ul>
            </nav>
            <div class="mt-auto">
                <a href="#" class="block px-4 py-2 hover:bg-red-700 bg-red-600 rounded text-center">تسجيل الخروج</a>
            </div>
        </aside>

        <!-- Main content -->
        <main class="flex-1 p-6 overflow-y-auto">
            @yield('admin-content')
        </main>
    </div>
    @livewireScripts
</body>
</html>
