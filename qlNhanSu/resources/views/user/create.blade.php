<x-app-layout>
    @extends('header')
        @section('main-content')
        <section class="content bg-white" style="height: 85vh">
            <h1 class="text-center text-dark">Thêm tài khoản</h1>

            <div class="container-fluid col-8">
                <div class="row">
                    <div class="col-sm">
                        <form id="#formUser" enctype="multipart/form-data" method="post" action="{{ route('users.store') }}" class="m-5 mt-2 formUser">
                            @csrf

                            <div class="input-group mt-3 mb-3">
                                <label class="input-group-text" for="">Tên hiển thị:</label>
                                <input class="form-control" type="text" name="name" id="name" value="{{ old('name') }}">
                            </div>
                            @error('name')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror

                            <div class="input-group mt-3 mb-3">
                                <label class="input-group-text" for="">Tài khoản:</label>
                                <input class="form-control" name="account" id="account" value="{{ old('account') }}">
                            </div>
                            @error('account')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror

                            <div class="input-group mt-3 mb-3">
                                <label class="input-group-text" for="">Mật khẩu:</label>
                                <input class="form-control" type="password" name="password" id="password" value="{{ old('password') }}">
                            </div>
                            @error('password')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror

                            <div class="input-group mt-3 mb-3">
                                <label class="input-group-text" for="">Email:</label>
                                <input class="form-control" type="email" name="email" id="email" value="{{ old('email') }}">
                            </div>
                            @error('email')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror

                            {{-- <div class="input-group mt-3 mb-3">
                                <label class="input-group-text" for="">Ảnh đại diện:</label>
                                <input class="form-control" type="file" name="avatar" id="" value="{{ old('avatar') }}">
                            </div>
                            @error('avatar')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror --}}

                            <div class="input-group mt-3 mb-3">
                                <label class="input-group-text" for="">Quyền:</label>
                                <select name="role" id="role">
                                    <option value="0">Admin</option>
                                    <option value="1">Người dùng thường</option>
                                </select>
                            </div>

                            <div class="form-group  float-end ">
                                <a href="{{ route('users.index') }}" class="btn btn-secondary ">Back</a>
                                <input type="submit" value="Create" class="btn btn-primary" name="btAdd" id="btAddUser">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>

        <script src="https://cdn.jsdelivr.net/jquery.validation/1.15.1/jquery.validate.min.js"></script>
        <script src="{{ asset('assets') }}/js/app.js"></script>
        <script>

            $('.formUser').submit(function(e) {
                e.preventDefault();
                $.ajax({
                    url: "{{ route('users.store') }}",
                    type: 'post',
                    data: $('.formUser').serialize(),
                    success: function (response) {
                        if(response.status == true){
                            $('#name').val('');
                            console.log(response)
                            toastr.options = {
                                "closeButton": true,
                                "progressBar": true,
                                "positionClass": "toast-bottom-right",
                            }
                            toastr.success('Thêm tài khoản mới thành công');
                        }else if(response.status == false){
                            // alert(response.error)
                        }
                    },
                    error: function() {
                        toastr.error('Kiểm tra');
                    }
                })
            })
        </script>

        @endsection
</x-app-layout>
