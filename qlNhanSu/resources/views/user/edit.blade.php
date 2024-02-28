<x-app-layout>
    @extends('header')
    @section('main-content')
        <section class="content bg-white" style="height: 85vh">
    {{-- <body> --}}
        <h1 class="text-center text-dark">Chỉnh sửa thông tin tài khoản</h1>

        <div class="container-fluid col-8">
            <div class="row">
                <div class="col-sm">
                <form class="formUser" enctype="multipart/form-data" method="post" action="{{ route("users.update", $user->id) }}" class="m-5 mt-2 formUser">
                    @csrf
                    @method('PUT')

                    <div class="input-group mt-3 mb-3">
                        <label class="input-group-text" for="">Tên hiển thị:</label>
                        <input class="form-control" type="text" name="name" id="name" value="{{ $user->name }}">
                    </div>
                    @error('name')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror

                    <div class="input-group mt-3 mb-3">
                        <label class="input-group-text" for="">Tài khoản:</label>
                        <input class="form-control" name="account" id="account" value="{{ $user->account }}">
                    </div>
                    @error('account')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror

                    {{-- <div class="input-group mt-3 mb-3"> --}}
                        {{-- <label class="input-group-text" for="">Mật khẩu:</label> --}}
                        <input class="form-control" type="hidden" name="password" id="password" value="{{ $user->password }}">
                    {{-- </div> --}}

                    <div class="input-group mt-3 mb-3">
                        <label class="input-group-text" for="">Email:</label>
                        <input class="form-control" type="email" name="email" id="email" value="{{ $user->email }}">
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

                    <div class="form-group float-end">
                        <a href="{{ route("users.index") }}" class="btn btn-secondary">Back</a>
                        <input type="submit" name="btSave" value="Save" class="btn btn-primary">
                    </div>
                </form>
                </div>
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    <script>window.baseUrl = "{{ URL::to('/') }}";</script>
    <script src="{{ asset('assets') }}/js/editUser.js"></script>
    @endsection
</x-app-layout>
