<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>لوحة تحكم المدير</title>
    @livewireStyles
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.min.js" defer></script>
</head>
<body class="bg-gray-100" x-data="{ page: 'home', open: false }">

    <div class="flex flex-row-reverse">
        <!-- Sidebar -->
        <div class="w-64 bg-gray-800 text-white h-screen">
            <div class="text-center p-6 font-bold text-2xl">إدارة المهام</div>
            <ul>
                <li><a href="#" @click.prevent="page = 'home'" class="block px-4 py-2 hover:bg-gray-700">الصفحة الرئيسية</a></li>
                <li><a href="#" @click.prevent="page = 'tasks'" class="block px-4 py-2 hover:bg-gray-700">المهام</a></li>
                <li><a href="#" @click.prevent="page = 'groups'" class="block px-4 py-2 hover:bg-gray-700">المجموعات</a></li>
                <li><a href="#" @click.prevent="page = 'users'" class="block px-4 py-2 hover:bg-gray-700">المستخدمين</a></li>
                <li><a href="#" @click.prevent="page = 'reports'" class="block px-4 py-2 hover:bg-gray-700">التقارير</a></li>
                <li><a href="#" @click.prevent="page = 'settings'" class="block px-4 py-2 hover:bg-gray-700">الإعدادات</a></li>
                <li><a href="#" class="block px-4 py-2 hover:bg-gray-700">تسجيل الخروج</a></li>
            </ul>
        </div>
        <!-- Main Content -->
        <div class="flex-1 p-6">
            <header class="flex justify-between items-center mb-8">
                <h1 class="text-3xl font-bold">لوحة تحكم المدير</h1>
                <div class="relative">
                    <button @click="open = !open" class="px-4 py-2 bg-blue-500 text-white rounded">إعدادات الحساب</button>
                    <div x-show="open" class="absolute left-0 bg-white shadow-lg rounded mt-2 p-4 z-50">
                        <ul>
                            <li><a href="#" class="block px-4 py-2 text-black">الملف الشخصي</a></li>
                            <li><a href="#" class="block px-4 py-2 text-black">تغيير كلمة المرور</a></li>
                            <li><a href="#" class="block px-4 py-2 text-black">تسجيل الخروج</a></li>
                        </ul>
                    </div>
                </div>
            </header>

            <!-- صفحات ديناميكية حسب الاختيار -->
            <div x-show="page === 'home'">
                <!-- Statistics Section -->
                <div class="grid grid-cols-3 gap-6 mb-8">
                    <div class="bg-white p-6 shadow rounded">
                        <h3 class="text-xl font-semibold">المهام المفتوحة</h3>
                        <p class="text-2xl">10</p>
                    </div>
                    <div class="bg-white p-6 shadow rounded">
                        <h3 class="text-xl font-semibold">المجموعات النشطة</h3>
                        <p class="text-2xl">5</p>
                    </div>
                    <div class="bg-white p-6 shadow rounded">
                        <h3 class="text-xl font-semibold">المستخدمين</h3>
                        @livewire('admin.users.index')
                    </div>
                </div>
            </div>

            <div x-show="page === 'tasks'">
                <h2 class="text-xl font-bold mb-4">قائمة المهام</h2>
                @livewire('admin.tasks.index')
            </div>
            
            <div x-show="page === 'groups'">
                <h2 class="text-xl font-bold mb-4">المجموعات</h2>
            </div>
            
            <div x-show="page === 'users'">
                <h2 class="text-xl font-bold mb-4">المستخدمين</h2>
                <p>هنا سيتم عرض المستخدمين.</p>
                @livewire('admin.users.index')
            </div>

            <div x-show="page === 'reports'">
                <h2 class="text-xl font-bold mb-4">التقارير</h2>
                <p>عرض التقارير هنا.</p>
                @livewire('admin.reports.index')
            </div>

            <div x-show="page === 'settings'">
                <h2 class="text-xl font-bold mb-4">الإعدادات</h2>
                <p>إعدادات النظام.</p>
                @livewire('admin.settings.index')
            </div>
        </div>
    </div>
    @livewireScripts
</body>
</html>
