<div>
    <?php

use App\Livewire\Forms\LoginForm;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{
    public LoginForm $form;

    /**
     * Handle an incoming authentication request.
     */
    public function login(): void
    {
        $this->validate();

        $this->form->authenticate();

        Session::regenerate();

        $this->redirectIntended(default: route('/dashboard', absolute: false), navigate: true);
    }
};
?>
@extends('layouts.app')
@section('content')
    
<div>

<div class="w-full max-w-md bg-gradient-to-r from-blue-500 bg-white items-center mt-12 p-4 rounded-lg shadow-md">
    <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">تسجيل الدخول</h2>
    
        @if (session('message'))
            <div class="mb-4 text-green-600 text-sm">
                {{ session('message') }}
            </div>
        @endif
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
                @error('email')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
               @enderror

            </div>

            <div class="mb-4">
                <label for="password" class="block text-sm font-medium text-gray-700 mb-1">كلمة المرور</label>
                <input type="password" name="password" id="password" required
                       class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring focus:ring-indigo-200">
                       @error('password')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror

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
</div>
    @endsection