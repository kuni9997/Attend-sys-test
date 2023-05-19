<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <a href="/" class="font-sans text-xl font-bold">会員登録</a>
            </a>
        </x-slot>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div>

                <x-input id="name" class="block mt-1 w-full" type="text" name="name" placeholder="{{ __('Name') }}" :value="old('name')" required autofocus />
            </div>

            <!-- Email Address -->
            <div class="mt-4">

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" placeholder="{{ __('Email') }}" :value="old('email')" required />
            </div>

            <!-- Password -->
            <div class="mt-4">

                <x-input id="password" class="block mt-1 w-full"
                                placeholder="{{ __('Password') }}"
                                type="password"
                                name="password"
                                required autocomplete="new-password" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">

                <x-input id="password_confirmation" class="block mt-1 w-full"
                                placeholder="{{ __('Confirm Password') }}"
                                type="password"
                                name="password_confirmation" required />
            </div>

            <div class="flex items-center justify-end mt-6">
                <x-button class="w-full">
                    {{ __('Register') }}
                </x-button>
            </div>
        </form>

        <div class="register-button--button flex flex-col items-center mt-12">
            <p class="guidance text-gray-400 font-bold ">アカウントをお持ちの方はこちらから</p>
            <a href="/login" class="text-blue-500">ログイン</a>
        </div>
    </x-auth-card>
</x-guest-layout>
