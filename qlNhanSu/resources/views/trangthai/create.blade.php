<x-app-layout>
    @extends('header')
        @section('main-content')
        <section class="content bg-white" style="height: 85vh">
            <h1 class="text-center text-dark">Thêm trạng thái</h1>

            <div class="container-fluid col-8">
                <div class="row">
                    <div class="col-sm">
                        <form id="formTrangThai" method="post" action="{{ route('trangthais.store') }}" class="m-5 mt-2 formTrangThai">
                            @csrf

                            <div class="input-group mt-3 mb-3">
                                <label class="input-group-text" for="">Mã trạng thái:</label>
                                <input class="form-control pt90" type="text" name="maTrangThai" id="maTrangThai" value="{{ old('maTrangThai') }}" placeholder="(*)">
                                <span id="errorMaTrangThai" class="error">Mã trạng thái đã tồn tại</span>
                            </div>

                            <div class="input-group mt-3 mb-3">
                                <label class="input-group-text" for="">Tên trạng thái:</label>
                                <input class="form-control pt90" name="tenTrangThai" id="tenTrangThai" value="{{ old('tenTrangThai') }}" placeholder="(*)">
                                <span id="errorTenTrangThai" class="error">Tên trạng thái đã tồn tại</span>
                            </div>

                            <div class="form-group  float-end ">
                                <a href="{{ route('trangthais.index') }}" class="btn btn-secondary ">Quay lại</a>
                                <input type="submit" value="Xác nhận" class="btn btn-primary" name="btAdd" id="btAddTrangThai">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>

        <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
        <script>
            $('#errorTenTrangThai').hide();
            $('#errorMaTrangThai').hide();
            $('#formTrangThai').validate({
                rules:{
                    maTrangThai:{
                        required: true
                    },
                    tenTrangThai:{
                        required: true
                    }
                }
                ,messages:{
                    maTrangThai: {
                        required: "Vui lòng nhập mã trạng thái"
                    },
                    tenTrangThai: {
                        required: "Vui lòng nhập tên trạng thái"
                    },
                }
            });
            $(document).on('keyup', '#maTrangThai', function(){
                $.ajax({
                    url: '{{ route("check_maTrangThai_unique") }}',
                    type: 'get',
                    data: {
                        '_token': $('meta[name="csrf-token"]').attr('content'),
                        maTrangThai: function(){
                            return $('#maTrangThai').val();
                        }
                    },
                    success: function(response){
                        if(response == 'true'){
                            $("#errorMaTrangThai").show();
                        }else{
                            $("#errorMaTrangThai").hide();
                        }
                    }
                })
            });

            $(document).on('keyup', '#tenTrangThai', function(){
                $.ajax({
                    url: '{{ route("check_tenTrangThai_unique") }}',
                    type: 'get',
                    data: {
                        '_token': $('meta[name="csrf-token"]').attr('content'),
                        tenTrangThai: function(){
                            return $('#tenTrangThai').val();
                        }

                    },
                    success: function(response){
                        if(response == 'true'){
                            $("#errorTenTrangThai").show();
                        }else{
                            $("#errorTenTrangThai").hide();
                        }
                    }
                })
            });

            $(document).on('submit', '.formTrangThai', function(e) {
                e.preventDefault();
                if (!($("#errorMaTrangThai").is(":hidden")) || !($("#errorTenTrangThai").is(":hidden"))) {
                    toastr.warning('Kiểm tra lại dữ liệu nhập', 'Thông báo');
                } else {
                    $.ajax({
                    url: "{{ route('trangthais.store') }}",
                    type: 'post',
                    data: $('.formTrangThai').serialize(),
                    success: function (response) {
                        $('#maTrangThai').val('');
                        $('#tenTrangThai').val('');
                        toastr.options = {
                        "closeButton": true,
                            "progressBar": true,
                            "positionClass": "toast-bottom-right",
                        }
                        toastr.success('Thêm mới trạng thái thành công', 'Thông báo');
                    },
                    })
                }
            });
        </script>

        @endsection
</x-app-layout>
