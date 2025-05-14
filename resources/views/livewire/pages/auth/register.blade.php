<div>
    <?php

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{
    public string $name = '';
    public string $username = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';

    /**
     * Handle an incoming registration request.
     */
    public function register(): void
    {
        $validated = $this->validate([
            'name' => ['nullable', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'unique:users'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
        ]);
        $validated['password'] = Hash::make($validated['password']);

        event(new Registered($user = User::create($validated)));

        Auth::login($user);

        $this->redirect(route('dashboard', absolute: false), navigate: true);
    }
};
?>

<div dir="rtl" class="register-container">
    <form wire:submit="register">
        <!-- الاسم -->
        <div class="form-group">
            <x-input-label for="name" :value="__('الاسم')" />
            <x-text-input wire:model="name" id="name" class="block mt-1 w-full" type="text" name="name" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- البريد الإلكتروني -->
        <div class="form-group mt-4">
            <x-input-label for="email" :value="__('البريد الإلكتروني')" />
            <x-text-input wire:model="email" id="email" class="block mt-1 w-full" type="email" name="email" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- اسم المستخدم -->
        <div class="form-group mt-4">
            <x-input-label for="username" :value="__('اسم المستخدم')" />
            <x-text-input wire:model="username" id="username" class="block mt-1 w-full" type="text" name="username" required autocomplete="username" />
            <x-input-error :messages="$errors->get('username')" class="mt-2" />
        </div>

        <!-- كلمة المرور -->
        <div class="form-group mt-4">
            <x-input-label for="password" :value="__('كلمة المرور')" />
            <x-text-input wire:model="password" id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- تأكيد كلمة المرور -->
        <div class="form-group mt-4">
            <x-input-label for="password_confirmation" :value="__('تأكيد كلمة المرور')" />
            <x-text-input wire:model="password_confirmation" id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="actions flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}" wire:navigate>
                {{ __('هل لديك حساب؟') }}
            </a>

            <x-primary-button class="ms-3">
                {{ __('تسجيل') }}
            </x-primary-button>
        </div>
    </form>
</div>

<style>
    .register-container {
        max-width: 400px;
        margin: 40px auto 0;
        padding: 20px;
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .register-form {
        display: flex;
        flex-direction: column;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .actions {
        margin-top: 20px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .register-container .form-group input {
        border: 1px solid #ddd;
        border-radius: 4px;
        padding: 10px;
        margin-top: 8px;
    }

    .register-container .form-group label {
        font-weight: bold;
    }

    .register-container .form-group .text-sm {
        font-size: 12px;
    }
</style>

</div>