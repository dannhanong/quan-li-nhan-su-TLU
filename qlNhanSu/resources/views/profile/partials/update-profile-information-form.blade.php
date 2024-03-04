{{-- <x-app-layout> --}}
    @extends('header')
        @section('main-content')
        <section class="content" style="margin-left: 30%">
            <div class="container mt-1">
                <div>
                    <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                        {{ __('Thông tin tài khoản') }}
                    </h2>

                    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                        {{ __("Bạn có thể cập nhật thông tin tài khoản tại đây.") }}
                    </p>
                </div>

                {{-- <form id="send-verification" method="post" action="{{ route('verification.send') }}">
                    @csrf
                </form> --}}

                <form id="formEditUser" enctype="multipart/form-data" method="post" action="{{ route('profile.update') }}" class="formEditUser mt-6 space-y-6" style="padding: auto, 50%;">
                    @csrf
                    @method('patch')

                    {{-- Avatar --}}
                    <div class="container" >
                        <div class="row" style="width: 80%">
                            <div class="col-md-10 col-md-offset-1">
                                <img id="avatar-img-edit" src="/uploads/avatars/{{ $user->avatar }}" style="width: 150px; height: 150px; float:left; border-radius: 50%; margin-right: 25px;" alt="">
                                <label for="">Cập nhật ảnh đại diện</label>
                                <input type="file" name="avatar" id="avatar">
                                <span class="error" id="spanErrorAvatar">Chỉ chấp nhận các tệp ảnh PNG hoặc JPEG</span>
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            </div>
                        </div>
                    </div>

                    {{-- Name --}}
                    <div style="width: 60%">
                        <x-input-label for="name" :value="__('Tên hiển thị')" />
                        <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" autofocus autocomplete="name" />
                        <x-input-error class="mt-2" :messages="$errors->get('name')" />
                    </div>

                    {{-- Email --}}
                    <div style="width: 60%">
                        <x-input-label for="email" :value="__('Email')" />
                        <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
                        <x-input-error class="mt-2" :messages="$errors->get('email')" />

                        @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                            <div>
                                <p class="text-sm mt-2 text-gray-800 dark:text-gray-200">
                                    {{ __('Your email address is unverified.') }}

                                    <button form="send-verification" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                                        {{ __('Gửi lại mã xác nhận qua email.') }}
                                    </button>
                                </p>

                                @if (session('status') === 'verification-link-sent')
                                    <p class="mt-2 font-medium text-sm text-green-600 dark:text-green-400">
                                        {{ __('A new verification link has been sent to your email address.') }}
                                    </p>
                                @endif
                            </div>
                        @endif
                    </div>

                    <div class="flex items-center gap-4" style="width: 60%">
                        <x-primary-button id="btnSave">{{ __('Lưu') }}</x-primary-button>
                    </div>
                </form>
            </div>
        </section>

        <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>

        <script>
            $('#spanErrorAvatar').hide();
            $('#avatar').change(function() {
                var fileName = $(this).val();
                var extension = fileName.split('.').pop().toLowerCase();
                if ($.inArray(extension, ['png', 'jpg', 'jpeg']) == -1) {
                    $('#spanErrorAvatar').show()
                    $(this).val('');
                }else{
                    $('#spanErrorAvatar').hide();
                }
            });

            var accountF = $('#account').val();
            var emailF = $('#email').val();

            $('#formEditUser').validate({
                rules:{
                    account:{
                        required: true,
                        remote: {
                            url: '{{ route("check_account_unique") }}',
                            // url: baseUrl+'/check_account_unique',
                            type: 'post',
                            data: {
                                account: function(){
                                    return $('#account').val();
                                },
                                '_token': $('meta[name="csrf-token"]').attr('content'),
                                accountF: accountF
                            }
                        }
                    },
                    email:{
                        required: true,
                        email: true,
                        remote: {
                            url: '{{ route("check_email_unique") }}',
                            // url: baseUrl+'/check_email_unique',
                            type: 'post',
                            data: {
                                email: function(){
                                    return $('#email').val();
                                },
                                '_token': $('meta[name="csrf-token"]').attr('content'),
                                emailF: emailF
                            },
                        },
                    }
                },
                messages:{
                    account: {
                        required: "Trường tài khoản không được để trống",
                        remote: "Tài khoản đã tồn tại",
                    },
                    email: {
                        required: "Trường email không được để trống",
                        email: "Vui lòng nhập đúng định dạng email",
                        remote: "Email đã tồn tại",
                    },
                },
            });

            $(document).on('submit', '#formEditUser', function(e) {
                e.preventDefault();
                var formData = new FormData($('.formEditUser')[0]);
                $.ajax({
                    url: "{{ route('profile.update') }}",
                    type: 'post',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (response) {
                        $('#user-name').text(response.newName);
                        $('#avatar-img').attr('src', response.newAvatarUrl);
                        $('#avatar-img-edit').attr('src', response.newAvatarUrl);
                        toastr.options = {
                            "closeButton": true,
                            "progressBar": true,
                            "positionClass": "toast-bottom-right",
                        }
                        toastr.success('Cập nhật tài khoản thành công', 'Thông báo');
                    },
                });
            });
        </script>
    @endsection
{{-- </x-app-layout> --}}
