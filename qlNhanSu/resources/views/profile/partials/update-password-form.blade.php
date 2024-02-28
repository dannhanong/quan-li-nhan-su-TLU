{{-- <x-app-layout> --}}
    @extends('header')
        @section('main-content')
        <section class="content">
            <div class="container mt-4" style="width: 60%">
                <header>
                    <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                        {{ __('Đổi mật khẩu') }}
                    </h2>

                    {{-- <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                        {{ __('Ensure your account is using a long, random password to stay secure.') }}
                    </p> --}}
                </header>

                <form method="post" action="{{ route('password.update') }}" class="formUpdatePass mt-6 space-y-6" style="padding: auto, 50%;">
                    @csrf
                    @method('put')

                    <div>
                        <x-input-label for="update_password_current_password" :value="__('Nhập mật khẩu hiện tại')" />
                        <x-text-input id="update_password_current_password" name="current_password" type="password" class="mt-1 block w-full" autocomplete="current-password" />
                        <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="update_password_password" :value="__('Nhập mật khẩu mới')" />
                        <x-text-input id="update_password_password" name="password" type="password" class="mt-1 block w-full" autocomplete="new-password" />
                        <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="update_password_password_confirmation" :value="__('Xác nhận lại mật khẩu')" />
                        <x-text-input id="update_password_password_confirmation" name="password_confirmation" type="password" class="mt-1 block w-full" autocomplete="new-password" />
                        <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
                    </div>

                    <div class="flex items-center gap-4">
                        <x-primary-button>{{ __('Cập nhật') }}</x-primary-button>
                    </div>
                </form>
            </div>
        </section>

        <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
        <script>
            $('.formUpdatePass').validate({
                rules: {
                    current_password: {
                        required: true,
                        remote: {
                            url: "{{ route('check_current_password') }}",
                            type: 'post',
                            async: false,
                            data: {
                                current_password: function(){
                                    return $('#update_password_current_password').val();
                                },
                                '_token': $('meta[name="csrf-token"]').attr('content')
                            },
                        },
                    },

                    password:{
                        required: true,
                        minlength: 8,
                    },

                    password_confirmation: {
                        required: true,
                        equalTo: "#update_password_password",
                    }
                },
                messages: {
                    current_password: {
                        required: "Trường mật khẩu không được để trống",
                        remote: "Mật khẩu không chính xác",
                    },
                    password: {
                        required: "Mật khẩu mới không được để trống",
                        minlength: "Mật khẩu mới tối thiểu 8 kí tự",
                    },
                    password_confirmation: {
                        required: "Xác nhận mật khẩu không được để trống",
                        equalTo: "Mật khẩu xác nhận phải trùng với mật khẩu mới",
                    }
                }
            })

            $('.formUpdatePass').submit(function(e){
                e.preventDefault();
                $.ajax({
                    url: "{{ route('password.update') }}",
                    type: 'post',
                    data: $('.formUpdatePass').serialize(),
                    success: function(response){
                        $('#update_password_current_password').val('');
                        $('#update_password_password').val('');
                        $('#update_password_password_confirmation').val('');
                        toastr.options = {
                                "closeButton": true,
                                "progressBar": true,
                                "positionClass": "toast-bottom-right",
                            }
                        toastr.success('Đổi mật khẩu mới thành công');
                    }
                })
            })
        </script>
    @endsection
{{-- </x-app-layout> --}}
