<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <title>تسجيل الدخول</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @vite('resources/css/app.css') {{-- لو كنت تستخدم Vite --}}
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">

    <div class="w-full max-w-md bg-white p-8 rounded-lg shadow-md">
        <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">تسجيل الدخول</h2>

        @if (session('error'))
            <div class="mb-4 text-red-600 text-sm">
                {{ session('error') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">البريد الإلكتروني</label>
                <input type="email" name="email" id="email" required autofocus
                       class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring focus:ring-indigo-200"
                       value="{{ old('email') }}">
            </div>

            <div class="mb-4">
                <label for="password" class="block text-sm font-medium text-gray-700 mb-1">كلمة المرور</label>
                <input type="password" name="password" id="password" required
                       class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring focus:ring-indigo-200">
            </div>

            <div class="mb-4 flex items-center">
                <input type="checkbox" name="remember" id="remember" class="mr-2">
                <label for="remember" class="text-sm text-gray-600">تذكرني</label>
            </div>

            <button type="submit"
                    class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded-lg">
                تسجيل الدخول
            </button>
        </form>

        <div class="mt-4 text-center">
            <a href="{{ route('register') }}" class="text-sm text-indigo-600 hover:underline">ليس لديك حساب؟ سجل الآن</a>
        </div>
    </div>

</body>
</html>
