
<div x-data="{ open: false }" class="relative">
    <!-- Navbar -->
    <nav class="bg-green-600 text-white shadow-md fixed w-full z-50">
        <div class="max-w-7xl mx-auto px-4 py-3 flex items-center justify-between">
            <div class="text-2xl font-bold">نظام إدارة المهام</div>

            <!-- Desktop Menu -->
            <ul class="hidden md:flex space-x-6 text-sm font-semibold">
                <li><a href="#home" class="hover:text-green-200">الرئيسية</a></li>
                <li><a href="#about-project" class="hover:text-green-200">عن المشروع</a></li>
                <li><a href="#about-dev" class="hover:text-green-200">عن المطور</a></li>
                <li><a href="#tools" class="hover:text-green-200">الأدوات</a></li>
                <li><a href="#skills" class="hover:text-green-200">المهارات</a></li>
                <li><a href="#login" class="hover:text-green-200">تسجيل الدخول</a></li>
            </ul>

            <!-- Mobile Menu Button -->
            <button @click="open = !open" class="md:hidden text-white text-2xl">&#9776;</button>
        </div>

        <!-- Mobile Sidebar -->
        <div x-show="open" @click.away="open = false" class="md:hidden bg-green-700 text-white px-6 py-4 space-y-3">
            <a href="#home" class="block hover:text-green-300">الرئيسية</a>
            <a href="#about-project" class="block hover:text-green-300">عن المشروع</a>
            <a href="#about-dev" class="block hover:text-green-300">عن المطور</a>
            <a href="#tools" class="block hover:text-green-300">الأدوات</a>
            <a href="#skills" class="block hover:text-green-300">المهارات</a>
            @auth 
            <a href="#login" class="block hover:text-green-300"> لوحة التحكم</a>
            @else
            <a href="#login" class="block hover:text-green-300">تسجيل الدخول</a>
            @endauth

        </div>
    </nav>

    <!-- Main Content -->
    <div id="home" class="bg-gradient-to-br from-green-50 via-white to-green-100 min-h-screen pt-24 px-4 pb-10">
        <div class="max-w-7xl mx-auto text-center">
            <h1 class="text-4xl md:text-5xl font-extrabold text-green-700 mb-4 animate-fade-in">نظام إدارة المهام</h1>
            <p class="text-gray-600 text-lg md:text-xl mb-10 animate-fade-in-slow">
                سهّل إدارة فريقك ومهامك اليومية بواجهة بسيطة وذكية
            </p>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @foreach($cards as $card)
                    <div id="{{ $card['id'] }}"
                        class="bg-white rounded-2xl shadow-lg p-6 transform hover:-translate-y-1 hover:scale-105 transition duration-300 animate-fade-in"
                    >
                        <h2 class="text-xl font-bold text-green-600 mb-2">{{ $card['title'] }}</h2>
                        @if(is_array($card['content']))
                            <ul class="list-disc pr-5 space-y-1 text-gray-700 text-right">
                                @foreach($card['content'] as $item)
                                    <li>{{ $item }}</li>
                                @endforeach
                            </ul>
                        @else
                            <p class="text-gray-700 leading-relaxed">{{ $card['content'] }}</p>
                        @endif
                    </div>
                @endforeach
            </div>
            @auth
            <div id="login" class="mt-12">
                <a href="{{ route('dashboard') }}"
                    class="bg-green-600 hover:bg-green-700 text-white font-semibold px-6 py-3 rounded-full shadow-lg transition duration-300 animate-bounce">
                   لوحة التحكم
                </a>
            </div>
            @else
            <div id="login" class="mt-12">
                <a href="{{ route('login') }}"
                    class="bg-green-600 hover:bg-green-700 text-white font-semibold px-6 py-3 rounded-full shadow-lg transition duration-300 animate-bounce">
                    تسجيل الدخول
                </a>
            </div>
            @endauth
        </div>
    </div>

    <!-- Animations -->
    <style>
        @keyframes fade-in {
            0% { opacity: 0; transform: translateY(20px); }
            100% { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-in {
            animation: fade-in 0.6s ease-out forwards;
        }
        .animate-fade-in-slow {
            animation: fade-in 1.2s ease-out forwards;
        }
    </style>
</div>
