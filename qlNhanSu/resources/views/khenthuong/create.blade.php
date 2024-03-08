<x-app-layout>
    @extends('header')
        @section('main-content')
        <section class="content bg-white" style="height: 85vh">
            <h1 class="text-center text-dark">Thêm khen thưởng</h1>

            <div class="container-fluid col-8">
                <div class="row">
                    <div class="col-sm">
                        <form id="#formKhenthuong" method="post" action="{{ route('khenthuongs.store') }}" class="m-5 mt-2 formKhenthuong">
                            @csrf

                            <div class="input-group mt-3 mb-3">
                                <div class="input-group">
                                    <label class="input-group-text" for="">Tên nhân sự:</label>
                                    <select name="Manhansu" id="Manhansu">
                                        @foreach ($nhansus as $nhansu)
                                            <option value="{{ $nhansu->id }}">
                                                {{ $nhansu->Hoten }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="input-group mt-3 mb-3">
                                <label class="input-group-text" for="">Ngày khen thưởng:</label>
                                <input class="form-control pt90" type="date" name="ngayKhenThuong" id="ngayKhenThuong" value="{{ old('ngayKhenThuong') }}" placeholder="(*)">
                            </div>

                            <div class="input-group mt-3 mb-3">
                                <label class="input-group-text" for="">Lý do:</label>
                                <input class="form-control pt90" name="lyDo" id="lyDo" value="{{ old('lyDo') }}" placeholder="(*)">
                            </div>

                            <div class="mt-3 mb-3">
                                <label class="input-group-text" for="">Chi tiết khen thưởng:</label>
                                <textarea class="form-control" name="chiTietKhenThuong" id="chiTietKhenThuong" value="{{ old('chiTietKhenThuong') }}" placeholder="(*)" rows="3"></textarea>
                            </div>

                            <div class="form-group  float-end ">
                                <a href="{{ route('khenthuongs.index') }}" class="btn btn-secondary ">Quay lại</a>
                                <input type="submit" value="Xác nhận" class="btn btn-primary" name="btAdd" id="btAddKhenthuong">
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </section>

        <script>
            $(document).on('submit', '.formKhenthuong', function(e) {
            e.preventDefault();
            $.ajax({
                url: "{{ route('khenthuongs.store') }}",
                type: 'post',
                data: $('.formKhenthuong').serialize(),
                success: function (response) {
                    // Handle success
                    $('#ngayKhenThuong').val('');
                    $('#lyDo').val('');
                    $('#chiTietKhenThuong').val('');
                    $('#maKhoa').val('');
                    toastr.options = {
                        "closeButton": true,
                        "progressBar": true,
                        "positionClass": "toast-bottom-right",
                    }
                    toastr.success('Thêm mới khen thưởng thành công', 'Thông báo');
                },
                error: function (xhr, status, error) {
                    // Handle errors
                    toastr.options = {
                        "closeButton": true,
                        "progressBar": true,
                        "positionClass": "toast-bottom-right",
                    }
                    toastr.error('Đã xảy ra lỗi. Vui lòng nhập đầy đủ.', 'Thông báo');
                },
            });
        });
        </script>

        @endsection
</x-app-layout>
