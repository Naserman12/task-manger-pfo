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

        $this->redirectIntended(default: route('dashboard', absolute: false), navigate: true);
    }
};
?>

<div dir="rtl" class="login-container">
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form wire:submit="login" class="login-form">
        <!-- البريد الإلكتروني -->
        <div class="form-group">
            <x-input-label for="email" :value="__('البريد الإلكتروني')" />
            <x-text-input wire:model="form.email" id="email" class="block mt-1 w-full" type="email" name="email" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('form.email')" class="mt-2" />
        </div>

        <!-- كلمة المرور -->
        <div class="form-group mt-4">
            <x-input-label for="password" :value="__('كلمة المرور')" />
            <x-text-input wire:model="form.password" id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('form.password')" class="mt-2" />
        </div>

        <!-- تذكرني -->
        <div class="remember-me mt-4">
            <label for="remember" class="inline-flex items-center">
                <input wire:model="form.remember" id="remember" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('تذكرني') }}</span>
            </label>
        </div>

        <div class="actions flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}" wire:navigate>
                    {{ __('نسيت كلمة السر?') }}
                </a>
            @endif

            <x-primary-button class="ms-3">
                {{ __('تسجيل الدخول') }}
            </x-primary-button>

            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('register') }}" wire:navigate>
                {{ __('ليس لديك حساب؟') }}
            </a>
        </div>
    </form>
</div>

<style>
    .login-container {
        max-width: 400px;
        margin: 40px auto 0;
        padding: 20px;
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .login-form {
        display: flex;
        flex-direction: column;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .remember-me {
        margin-top: 10px;
    }

    .actions {
        margin-top: 20px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .login-container .form-group input {
        border: 1px solid #ddd;
        border-radius: 4px;
        padding: 10px;
        margin-top: 8px;
    }

    .login-container .form-group label {
        font-weight: bold;
    }

    .login-container .form-group .text-sm {
        font-size: 12px;
    }
</style>

</div>