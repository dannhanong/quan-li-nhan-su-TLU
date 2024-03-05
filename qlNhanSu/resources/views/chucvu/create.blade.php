<x-app-layout>
    @extends('header')
        @section('main-content')
        <section class="content bg-white" style="height: 85vh">
            <h1 class="text-center text-dark">Thêm chức vụ</h1>

            <div class="container-fluid col-8">
                <div class="row">
                    <div class="col-sm">
                        <form id="#formChucvu" method="post" action="{{ route('chucvus.store') }}" class="m-5 mt-2 formChucvu">
                            @csrf

                            <div class="input-group mt-3 mb-3">
                                <label class="input-group-text" for="">Mã chức vụ:</label>
                                <input class="form-control pt90" type="text" name="maChucVu" id="maChucVu" value="{{ old('maChucVu') }}" placeholder="(*)">
                            </div>

                            <div class="input-group mt-3 mb-3">
                                <label class="input-group-text" for="">Tên chức vụ:</label>
                                <input class="form-control pt90" name="tenChucVu" id="tenChucVu" value="{{ old('tenChucVu') }}" placeholder="(*)">
                            </div>

                            <div class="form-group  float-end ">
                                <a href="{{ route('chucvus.index') }}" class="btn btn-secondary ">Quay lại</a>
                                <input type="submit" value="Xác nhận" class="btn btn-primary" name="btAdd" id="btAddChucvu">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>

        <script>
            $(document).on('submit', '.formChucvu', function(e) {
                e.preventDefault();
                $.ajax({
                    url: "{{ route('chucvus.store') }}",
                    type: 'post',
                    data: $('.formChucvu').serialize(),
                    success: function (response) {
                        $('#maChucVu').val('');
                        $('#tenChucVu').val('');
                        toastr.options = {
                        "closeButton": true,
                            "progressBar": true,
                            "positionClass": "toast-bottom-right",
                        }
                        toastr.success('Thêm mới chức vụ thành công', 'Thông báo');
                    },
                })
            });
        </script>

        @endsection
</x-app-layout>
