<x-app-layout>
    @extends('header')
        @section('main-content')
        <section class="content bg-white" style="height: 85vh">
            <h1 class="text-center text-dark">Thêm chức vụ</h1>

            <div class="container-fluid col-8">
                <div class="row">
                    <div class="col-sm">
                        <form enctype="multipart/form-data" method="post" action="{{ route('chucvus.store') }}" class="m-5 mt-2">
                            @csrf

                            <div class="input-group mt-3 mb-3">
                                <label class="input-group-text" for="">Tên chức vụ:</label>
                                <input class="form-control" type="text" name="tenChucVu" id="" value="{{ old('tenChucVu') }}">
                            </div>
                            @error('tenChucVu')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror

                            <div class="form-group  float-end ">
                                <a href="{{ route('chucvus.index') }}" class="btn btn-secondary ">Back</a>
                                <input type="submit" value="Create" class="btn btn-primary" name="btAdd">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
        @endsection
</x-app-layout>
