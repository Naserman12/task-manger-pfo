<div>
    @section('pageTitle', 'الرائيسية')
    @php
        $title = 'home';
    @endphp
    <!-- Main Content -->
    <div id="home" class="bg-gradient-to-br from-blue-50 via-white to-blue-100 min-h-screen pt-24 px-4 pb-10">
     <div class="max-w-7xl mx-auto text-center">
        <h1 class="text-4xl md:text-5xl font-extrabold text-blue-700 mb-4 animate-fade-in">نظام إدارة المهام</h1>
        <p class="text-gray-600 text-lg md:text-xl mb-10 animate-fade-in-slow">
            سهّل إدارة فريقك ومهامك اليومية بواجهة بسيطة وذكية
        </p>
        <div class="flex flex-col items-center gap-6">
            @foreach($cards as $card)
                <div id="{{ $card['id'] }}"
                    class="bg-white w-full max-w-md rounded-2xl shadow-lg p-6 transform hover:-translate-y-1 hover:scale-105 transition duration-300 animate-fade-in"
                >
                    <h2 class="text-xl font-bold text-blue-600 mb-2">{{ $card['title'] }}</h2>
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
                class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-3 rounded-full shadow-lg transition duration-300 animate-bounce">
               لوحة التحكم
            </a>
        </div>
        @else
        <div id="login" class="mt-12">
            <a href="{{ route('login') }}"
                class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-3 rounded-full shadow-lg transition duration-300 animate-bounce">
                تسجيل الدخول
            </a>
        </div>
        @endauth
    </div>
</div>