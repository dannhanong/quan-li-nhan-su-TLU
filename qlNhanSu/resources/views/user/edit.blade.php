<x-app-layout>
    @section('tit')
        <title>Chỉnh sửa tài khoản</title>
    @endsection
    @include('header')
    @section('main-content')
        <section class="content bg-white" style="height: 85vh">
    {{-- <body> --}}
        <h1 class="text-center text-dark">Chỉnh sửa thông tin tài khoản</h1>

        <div class="container-fluid">
            <div class="row">
                <div class="col-sm">
                <form enctype="multipart/form-data" method="post" action="{{ route("users.update", $user->id) }}" class = "m-5 mt-2">
                    @csrf
                    @method('PUT')

                    {{-- <label class="input-group-text" for="">name:</label>
                    <select class="form-control" name="name" id="" required>
                        @foreach ($aircrafts as $aircraft)
                            <option value="{{ $aircraft }}" {{ $aircraft == $user->Aircraft_ID ? 'selected' : '' }}>
                                {{ $aircraft }}
                            </option>
                        @endforeach
                    </select> --}}

                    <div class="input-group mt-3 mb-3">
                        <label class="input-group-text" for="">Tên hiển thị:</label>
                        <input class="form-control" type="text" name="name" id="" value="{{ $user->name }}">
                    </div>
                    @error('name')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror

                    <div class="input-group mt-3 mb-3">
                        <label class="input-group-text" for="">Tài khoản:</label>
                        <input class="form-control" name="account" id="" value="{{ $user->account }}">
                    </div>
                    @error('account')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror

                    {{-- <div class="input-group mt-3 mb-3">
                        <label class="input-group-text" for="">Genre:</label>
                        <select class="form-control" name="Genre" id="">
                            @foreach ($genres as $genre)
                                <option value="{{ $genre }}" {{ $genre == $user->Genre ? 'selected' : '' }}>
                                    {{ $genre }}
                                </option>
                            @endforeach
                            <option value="{{ $user->Genre }}">{{ $user->Genre }}</option>
                            <option value="Romance">Romance</option>
                            <option value="Horror">Horror</option>
                        </select>
                    </div> --}}

                    <div class="input-group mt-3 mb-3">
                        <label class="input-group-text" for="">Mật khẩu:</label>
                        <input class="form-control" type="password" name="password" id="" value="{{ $user->password }}">
                    </div>
                    @error('password')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror

                    <div class="input-group mt-3 mb-3">
                        <label class="input-group-text" for="">Email:</label>
                        <input class="form-control" type="email" name="email" id="" value="{{ $user->email }}">
                    </div>
                    @error('email')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror

                    {{-- <div class="input-group mt-3 mb-3">
                        <label class="input-group-text" for="">Ảnh đại diện:</label>
                        <input class="form-control" type="file" name="avatar" id="" value="{{ $user->avatar }}">
                    </div>
                    @error('avatar')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror --}}

                    <div class="input-group mt-3 mb-3">
                        <label class="input-group-text" for="">Quyền:</label>
                        <select name="role" id="">
                            <option value="0" {{ $user->role == 0 ? 'selected' : '' }}>Admin</option>
                            <option value="1" {{ $user->role == 1 ? 'selected' : '' }}>Người dùng</option>
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
    @endsection
</x-app-layout>
