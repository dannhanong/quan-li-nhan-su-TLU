<x-app-layout>
    @extends('header')
        @section('main-content')
        <section class="content bg-white" style="height: 85vh">
            <h1 class="text-center text-dark">Thêm khoa</h1>

            <div class="container-fluid col-8">
                <div class="row">
                    <div class="col-sm">
                        <form id="#formKhoa" method="post" action="{{ route('khoas.store') }}" class="m-5 mt-2 formKhoa">
                            @csrf

                            <div class="input-group mt-3 mb-3">
                                <label class="input-group-text" for="">Mã khoa:</label>
                                <input class="form-control pt90" type="text" name="maKhoa" id="maKhoa" value="{{ old('maKhoa') }}" placeholder="(*)">
                            </div>

                            <div class="input-group mt-3 mb-3">
                                <label class="input-group-text" for="">Tên khoa:</label>
                                <input class="form-control pt90" name="tenKhoa" id="tenKhoa" value="{{ old('tenKhoa') }}" placeholder="(*)">
                            </div>

                            <div class="form-group  float-end ">
                                <a href="{{ route('khoas.index') }}" class="btn btn-secondary ">Quay lại</a>
                                <input type="submit" value="Xác nhận" class="btn btn-primary" name="btAdd" id="btAddKhoa">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>

        <script>
            $(document).on('submit', '.formKhoa', function(e) {
                e.preventDefault();
                $.ajax({
                    url: "{{ route('khoas.store') }}",
                    type: 'post',
                    data: $('.formKhoa').serialize(),
                    success: function (response) {
                        $('#maKhoa').val('');
                        $('#tenKhoa').val('');
                        toastr.options = {
                        "closeButton": true,
                            "progressBar": true,
                            "positionClass": "toast-bottom-right",
                        }
                        toastr.success('Thêm mới khoa thành công', 'Thông báo');
                    },
                })
            });
        </script>

        @endsection
</x-app-layout>
