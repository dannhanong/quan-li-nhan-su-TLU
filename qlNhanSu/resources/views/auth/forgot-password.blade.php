<x-guest-layout>
    @extends('header')
    <div style="width: 40%; margin-left: 28%" class="mt-4">
        <div class="mb-4 text-sm text-gray-600 dark:text-gray-400 mt-2">
            {{ __('Nhập email đã được đăng ký của bạn.') }}
        </div>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('password.email') }}" style="width: 70%" class="mt-2">
            @csrf

            <!-- Email Address -->
            <div>
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-primary-button>
                    {{ __('Đặt lại mật khẩu bằng email này') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</x-guest-layout>
