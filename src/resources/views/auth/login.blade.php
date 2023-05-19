<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/" class="font-sans text-xl font-bold">ログイン</a>
        </x-slot>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            <div>
                <x-input id="email" class="block mt-1 w-full" type="email" name="email" placeholder="{{ __('Email') }}" :value="old('email')" required autofocus />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-input id="password" class="block mt-1 w-full" placeholder="{{ __('Password') }}" 
                                type="password"
                                name="password"
                                required autocomplete="current-password" />
            </div>

            <div class="flex items-center justify-end mt-6 w-full">

                <x-button class="w-full">
                    {{ __('Log in') }}
                </x-button>
            </div>
        </form>
        <div class="register-button--button flex flex-col items-center mt-12">
                <p class="guidance text-gray-400 font-bold ">アカウントをお持ちでない方はこちらから</p>
                <a href="/register" class="text-blue-500">会員登録</a>
        </div>
    </x-auth-card>
</x-guest-layout>
