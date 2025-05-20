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

        $this->redirect(route('/dashboard', absolute: false), navigate: true);
    }
};
?>
@extends('layouts.app')
@section('content')
<div>  
    <div class="w-full bg-gradient-to-r from-blue-500 mt-4 max-w-md  bg-white  p-8 rounded-lg shadow-md">
    <h2 class="text-2xl font-bold bg-blue-900 text-center text-gray-800 mb-6">تسجيل جديد</h2>
    
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
    <form method="POST" action="{{ route('register') }}" dir="rtl">
        @csrf
        
            <div>
                <x-label for="name" value="الاسم الكامل" />
                <x-input id="name" class="block mt-1 w-full text-right" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                @error('name')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                 @enderror
            </div>
                 
                 <div class="mt-4">
                     <x-label for="username" value="اسم المستخدم" />
                     <x-input id="username" class="block mt-1 w-full text-right" type="text" name="username" :value="old('username')" required autocomplete="username" />
                     @error('username')
                             <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                      @enderror
                    </div>
                    
                    <div class="mt-4">
                        <x-label for="email" value="البريد الإلكتروني" />
                        <x-input id="email" class="block mt-1 w-full text-right" type="email" name="email" :value="old('email')" required autocomplete="email" />
                        @error('email')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                         @enderror
                        </div>
                        
                        <div class="mt-4">
                            <x-label for="password" value="كلمة المرور" />
                            <x-input id="password" class="block mt-1 w-full text-right" type="password" name="password" required autocomplete="new-password" />
                            @error('password')
                                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                             @enderror
                            </div>
                            
                            <div class="mt-4">
                                <x-label for="password_confirmation" value="تأكيد كلمة المرور" />
                                <x-input id="password_confirmation" class="block mt-1 w-full text-right" type="password" name="password_confirmation" required autocomplete="new-password" />
                                @error('password_confirmation')
                                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                                 @enderror
                            </div>
            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                <div class="mt-4 text-right">
                    <x-label for="terms">
                        <div class="flex items-center justify-end">
                            <x-checkbox name="terms" id="terms" required />
                            <div class="mr-2 text-sm text-gray-600">
                                {!! __('أوافق على :terms_of_service و :privacy_policy', [
                                    'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-blue-600 hover:text-blue-800">'.__('شروط الاستخدام').'</a>',
                                    'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-blue-600 hover:text-blue-800">'.__('سياسة الخصوصية').'</a>',
                                ]) !!}
                            </div>
                        </div>
                    </x-label>
                </div>
            @endif

            <div class="flex items-center justify-between mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    هل لديك حساب؟ تسجيل الدخول
                </a>
                <x-button class="bg-blue-500 hover:bg-blue-600 text-white">
                    تسجيل
                </x-button>
            </div>
        </form>
    </div>
    </div>
@endsection 

