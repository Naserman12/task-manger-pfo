@extends('layouts.app')
@section('content')
<div>
    
    <form method="POST" action="{{ route('register') }}" dir="rtl">
        @csrf
        
            <div>
                <x-label for="name" value="الاسم الكامل" />
                <x-input id="name" class="block mt-1 w-full text-right" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            </div>

            <div class="mt-4">
                <x-label for="username" value="اسم المستخدم" />
                <x-input id="username" class="block mt-1 w-full text-right" type="text" name="username" :value="old('username')" required autocomplete="username" />
            </div>

            <div class="mt-4">
                <x-label for="email" value="البريد الإلكتروني" />
                <x-input id="email" class="block mt-1 w-full text-right" type="email" name="email" :value="old('email')" required autocomplete="email" />
            </div>

            <div class="mt-4">
                <x-label for="password" value="كلمة المرور" />
                <x-input id="password" class="block mt-1 w-full text-right" type="password" name="password" required autocomplete="new-password" />
            </div>

            <div class="mt-4">
                <x-label for="password_confirmation" value="تأكيد كلمة المرور" />
                <x-input id="password_confirmation" class="block mt-1 w-full text-right" type="password" name="password_confirmation" required autocomplete="new-password" />
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

                <x-button class="bg-yellow-500 hover:bg-yellow-600 text-white">
                    تسجيل
                </x-button>
            </div>
        </form>
    </div>
@endsection 

