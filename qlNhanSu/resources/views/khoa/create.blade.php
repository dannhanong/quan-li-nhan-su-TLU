<x-app-layout>
@include('header')
        <h1 class="text-center text-success">Thêm tài khoản</h1>

        <div class="container-fluid">
            <div class="row">
                <div class="col-sm">
                    <form method="post" action="{{ route('books.store') }}" class="m-5 mt-2">
                        @csrf

                        <div class="input-group mt-3 mb-3">
                            <label class="input-group-text" for="">Title:</label>
                            <input class="form-control" type="text" name="Title" id="" value="{{ old('Title') }}">
                        </div>
                        @error('Title')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror

                        <div class="input-group mt-3 mb-3">
                            <label class="input-group-text" for="">Author:</label>
                            <input class="form-control" name="Author" id="" value="{{ old('Author') }}">
                        </div>
                        @error('Author')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror

                        <div class="input-group mt-3 mb-3">
                            <label class="input-group-text" for="">Genre:</label>
                            <input class="form-control" type="text" name="Genre" id="" value="{{ old('Genre') }}">
                        </div>
                        @error('Genre')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror

                        <div class="input-group mt-3 mb-3">
                            <label class="input-group-text" for="">PublicationYear:</label>
                            <input class="form-control" type="text" name="PublicationYear" id="" value="{{ old('PublicationYear') }}">
                        </div>
                        @error('PublicationYear')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror

                        <div class="input-group mt-3 mb-3">
                            <label class="input-group-text" for="">ISBN:</label>
                            <input class="form-control" type="text" name="ISBN" id="" value = "{{ old('ISBN') }}">
                        </div>
                        @error('ISBN')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror

                        <div class="input-group mt-3 mb-3">
                            <label class="input-group-text" for="">CoverImageURL:</label>
                            <input class="form-control" type="text" name="CoverImageURL" id="" value="{{ old('CoverImageURL') }}">
                        </div>
                        @error('CoverImageURL')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror

                        <div class="form-group  float-end ">
                            <input type="submit" value="Create" class="btn btn-success" name="btAdd">
                            <a href="{{ route('books.index') }}" class="btn btn-warning ">Back</a>
                        </div>

                        {{-- <input class="btn btn-success" type="submit" value="Create"> --}}
                    </form>
                </div>
            </div>
        </div>
</x-app-layout>
@include('footer')


