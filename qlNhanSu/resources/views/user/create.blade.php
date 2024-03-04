<x-app-layout>
    @extends('header')
        @section('main-content')
        <section class="content bg-white" style="height: 85vh">
            <h1 class="text-center text-dark">Thêm tài khoản</h1>

            <div class="container-fluid col-8">
                <div class="row">
                    <div class="col-sm">
                        <form id="#formUser" enctype="multipart/form-data" method="post" action="" class="m-5 mt-2 formUser">
                            @csrf

                            <div class="input-group mt-3 mb-3">
                                <label class="input-group-text" for="">Tên hiển thị:</label>
                                <input class="form-control pt90" type="text" name="name" id="name" value="{{ old('name') }}">
                            </div>
                            @error('name')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror

                            <div class="input-group mt-3 mb-3">
                                <label class="input-group-text" for="">Tài khoản:</label>
                                <input class="form-control pt90" name="account" id="account" value="{{ old('account') }}" placeholder="(*)">
                            </div>
                            @error('account')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror

                            <div class="input-group mt-3 mb-3">
                                <label class="input-group-text" for="">Mật khẩu:</label>
                                <input class="form-control pt90" type="password" name="password" id="password" value="{{ old('password') }}" placeholder="(*)">
                            </div>
                            @error('password')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror

                            <div class="input-group mt-3 mb-3">
                                <label class="input-group-text" for="">Ảnh đại diện:</label>
                                <input class="form-control pt90" type="file" name="avatar" id="avatar" value="{{ old('avatar') }}">
                                <span class="error" id="spanErrorAvatar">Chỉ chấp nhận các tệp ảnh PNG hoặc JPEG</span>
                            </div>

                            <div class="input-group mt-3 mb-3">
                                <label class="input-group-text" for="">Email:</label>
                                <input class="form-control pt90" type="email" name="email" id="email" value="{{ old('email') }}" placeholder="(*)">
                            </div>
                            @error('email')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror

                            <div class="input-group mt-3 mb-3">
                                <label class="input-group-text" for="">Quyền:</label>
                                <select name="role" id="role">
                                    @foreach ($roles as $role)
                                        @if($role == 0){
                                            {{ $quyen = "Admin" }}
                                        }@elseif ($role == 1){
                                            {{ $quyen = "Người dùng thường" }}
                                        }
                                        @endif
                                        <option value="{{ $role }}">
                                            {{ $quyen }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group  float-end ">
                                <a href="{{ route('users.index') }}" class="btn btn-secondary ">Quay lại</a>
                                <input type="submit" value="Xác nhận" class="btn btn-primary" name="btAdd" id="btAddUser">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>

        <script src="https://cdn.jsdelivr.net/jquery.validation/1.15.1/jquery.validate.min.js"></script>
        <script>window.baseUrl = "{{ URL::to('/') }}";</script>
        <script src="{{ asset('assets') }}/js/app.js"></script>
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

            $(document).on('submit', '.formUser', function(e) {
                e.preventDefault();
                const formCreateUser = new FormData(this);
                $.ajax({
                    url: "{{ route('users.store') }}",
                    type: 'post',
                    data: formCreateUser,
                    cache: false,
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    success: function (response) {
                        $('#name').val('');
                        $('#account').val('');
                        $('#password').val('');
                        $('#email').val('');
                        $('#avatar').val('');
                        toastr.options = {
                        "closeButton": true,
                            "progressBar": true,
                            "positionClass": "toast-bottom-right",
                        }
                        toastr.success('Thêm tài khoản mới thành công', 'Thông báo');
                    },
                })
            })
        </script>

        @endsection
</x-app-layout>
