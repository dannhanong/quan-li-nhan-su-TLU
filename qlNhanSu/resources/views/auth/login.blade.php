<x-guest-layout>
    @include('header')
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="row" style="display: flex; background-color: #457B9D">
        <div class="col-md-5 container" style="position: relative; background-color: #457B9D; width: 35%; height: 100vh;">
            {{-- <p style="margin-top: 15%; margin-right: -15%; color: white; font-size: 20px" class="text-center">Đại học Thủy Lợi</p> --}}
            <img style="display: block; margin: 0 auto" class="mt-5" src="/images/logo.png" alt="" srcset="" width="80px">
            <img style="margin-top: 30%; position: absolute; top: 0; left: 0; width: 628px; height: 379px; transform: scale(0.95); z-index: 10;" src="/images/login-side-back.png">
            <img style="margin-top: 10%; position: absolute; top: 20px; left: 76px; width: 550px; height: 480px; object-fit: cover; z-index: 25;" src="/images/login-side-front.png">
        </div>

        <div class="col-md-7" style="margin-left: auto; margin-right: 0%; background-color: white; border-left: 5px solid white; padding-right: 11%; padding-left: 11%; border-top-left-radius: 70px;
        border-bottom-left-radius: 70px;">
            <p class="font-serif fs-3 text-center fw-normal mt-10" for="">Đăng nhập</p>
            <form method="POST" action="{{ route('login') }}" style="width: 470px; margin-top: 13%">
                @csrf

                <!-- Account -->
                <div>
                    <x-input-label for="account" :value="__('TÀI KHOẢN')" />
                    <x-text-input id="account" class="block mt-1 w-full" type="text" name="account" :value="old('account')" autofocus autocomplete="username" />
                    <x-input-error :messages="$errors->get('account')" class="mt-2" />
                </div>

                <!-- Password -->
                <div class="mt-4">
                    <x-input-label for="password" :value="__('MẬT KHẨU')" />

                    <x-text-input id="password" class="block mt-1 w-full"
                                    type="password"
                                    name="password"
                                    autocomplete="current-password" />

                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Remember Me -->
                <div class="block mt-4">
                    <label for="remember_me" class="inline-flex items-center">
                        <input id="remember_me" type="checkbox" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800" name="remember">
                        <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Nhớ thông tin đăng nhập') }}</span>
                    </label>
                </div>

                <div class="text-center align-items-center mt-4">
                    <x-primary-button style="background-color: #457B9D">
                        {{ __('Đăng nhập') }}
                    </x-primary-button>
                    <br>
                    @if (Route::has('password.request'))
                        <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" style="font-size: 12px; color: #457B9D" href="{{ route('password.request') }}">
                            {{ __('Quên mật khẩu') }}
                        </a>
                    @endif
                    <br> <br>
                </div>
                <label class="fst-italic" style="color: red; font-size: 14px">(*) Đăng nhập bằng tài khoản/mật khẩu của <span class="fst-italic fw-bold" style="color: red; font-size: 13px">trang khai báo thông tin thí sinh</span></label>
                <label class="fst-italic" style="color: red; font-size: 14px">(*) Email + Điện thoại hỗ trợ:</label> <br>
                <label class="fst-italic fw-bold" style="color: red; font-size: 14px">phanmemttth@tlu.edu.vn - 0865903174</label>  <br>
                <label><a style="color: red; href="">HƯỚNG DẪN SỬ DỤNG</a></label>
            </form>
        </div>
    </div>
</x-guest-layout>
