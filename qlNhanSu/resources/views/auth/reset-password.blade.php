@include('header')
<x-guest-layout>
    <form id="formResetPass" method="POST" action="{{ route('password.store') }}" style="width: 50%; margin-left: 20%">
        @csrf

        <!-- Password Reset Token -->
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email', $request->email)" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Mật khẩu')" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Xác nhận mật khẩu')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                                type="password"
                                name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
                {{ __('Đặt lại mật khẩu') }}
            </x-primary-button>
        </div>
    </form>

    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    <script>
        $('#formResetPass').validate({
            rules: {
                email: {
                    required: true,
                    email: true
                },
                password: {
                    required: true,
                    minlength: 8
                },
                password_confirmation: {
                    required: true,
                    equalTo: "#password"
                }
            },
            messages: {
                email: {
                    required: "Trường email không được để trống",
                    email: "Vui lòng nhập đúng định dạng email"
                },
                password: {
                    required: "Trường mật khẩu không được để trống",
                    minlength: "Mật khẩu tối thiểu 8 kí tự",
                },
                password_confirmation: {
                    required: "Xác nhận mật khẩu không được để trống",
                    equalTo: "Mật khẩu xác nhận phải trùng với mật khẩu"
                }
            }
        });
    </script>
    @extends('footer')
</x-guest-layout>
