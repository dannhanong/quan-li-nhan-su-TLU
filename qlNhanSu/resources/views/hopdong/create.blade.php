<x-app-layout>
    @extends('header')
        @section('main-content')
        <section class="content bg-white" style="height: 85vh">
            <h1 class="text-center text-dark">Thêm hợp đồng</h1>

            <div class="container-fluid col-8">
                <div class="row">
                    <div class="col-sm">
                        <form id="#formHopdong" method="post" action="{{ route('hopdongs.store') }}" class="m-5 mt-2 formHopdong">
                            @csrf
                            {{-- <div class="input-group">
                                <label class="input-group-text" for="">Mã nhân sự:</label>
                                <select name="Manhansu" id="Manhansu">
                                    @foreach ($nhansus as $nhansu)
                                        <option value="{{ $nhansu->id }}">
                                            {{ $nhansu->Manhansu }}
                                        </option>
                                    @endforeach
                                </select>
                            </div> --}}

                            <div class="input-group mt-3 mb-3">
                                <label class="input-group-text" for="">Mã nhân sự:</label>
                                <input class="form-control pt90" type="text" name="Manhansu" id="Manhansu" value="{{ old('Manhansu') }}" placeholder="(*)">
                            </div>

                            <div class="input-group mt-3 mb-3">
                                <label class="input-group-text" for="">Mã hợp đồng:</label>
                                <input class="form-control pt90" type="text" name="maHopdong" id="maHopdong" value="{{ old('maHopdong') }}" placeholder="(*)">
                            </div>



                            <div class="input-group mt-3 mb-3">
                                <label class="input-group-text" for="">Ngày bắt đầu:</label>
                                <input class="form-control pt90" type="date" name="Ngaybatdau" id="Ngaybatdau" value="{{ old('Ngaybatdau') }}" placeholder="(*)">
                            </div>

                            <div class="input-group mt-3 mb-3">
                                <label class="input-group-text" for="">Ngày kết thúc:</label>
                                <input class="form-control pt90" type="date" name="Ngayketthuc" id="Ngayketthuc" value="{{ old('Ngayketthuc') }}" placeholder="(*)">
                            </div>

                            <div class="input-group mt-3 mb-3">
                                <label class="input-group-text" for="">Ngày ký:</label>
                                <input class="form-control pt90" type="date" name="Ngayky" id="Ngayky" value="{{ old('Ngayky') }}" placeholder="(*)">
                            </div>

                            <div class="input-group mt-3 mb-3">
                                <label class="input-group-text" for="">Lần ký:</label>
                                <input class="form-control pt90" type="" name="Lanky" id="Lanky" value="{{ old('Lanky') }}" placeholder="(*)">
                            </div>

                            <div class="form-group  float-end ">
                                <a href="{{ route('hopdongs.index') }}" class="btn btn-secondary ">Quay lại</a>
                                <input type="submit" value="Xác nhận" class="btn btn-primary" name="btAdd" id="btAddHopdong">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>

        <script>
            $(document).on('submit', '.formHopdong', function(e) {
                e.preventDefault();
                $.ajax({
                    url: "{{ route('hopdongs.store') }}",
                    type: 'post',
                    data: $('.formHopdong').serialize(),
                    success: function (response) {
                        $('#maHopdong').val('');
                        $('#Manhansu').val('');
                        toastr.options = {
                        "closeButton": true,
                            "progressBar": true,
                            "positionClass": "toast-bottom-right",
                        }
                        toastr.success('Thêm mới hợp đồng thành công', 'Thông báo');
                    },
                })
            });
        </script>

        @endsection
</x-app-layout>
