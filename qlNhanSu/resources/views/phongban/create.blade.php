<x-app-layout>
    @extends('header')
        @section('main-content')
        <section class="content bg-white" style="height: 85vh">
            <h1 class="text-center text-dark">Thêm phòng ban</h1>

            <div class="container-fluid col-8">
                <div class="row">
                    <div class="col-sm">
                        <form id="formPhongBan" method="post" action="{{ route('phongbans.store') }}" class="m-5 mt-2 formPhongBan">
                            @csrf

                            <div class="input-group mt-3 mb-3">
                                <label class="input-group-text" for="">Mã phòng ban:</label>
                                <input class="form-control pt90" type="text" name="maPhongBan" id="maPhongBan" value="{{ old('maPhongBan') }}" placeholder="(*)">
                                <span id="errorMaPhongBan" class="error">Mã phòng ban đã tồn tại</span>
                            </div>

                            <div class="input-group mt-3 mb-3">
                                <label class="input-group-text" for="">Tên phòng ban:</label>
                                <input class="form-control pt90" name="tenPhongBan" id="tenPhongBan" value="{{ old('tenPhongBan') }}" placeholder="(*)">
                                <span id="errorTenPhongBan" class="error">Tên phòng ban đã tồn tại</span>
                            </div>

                            <div class="form-group  float-end ">
                                <a href="{{ route('phongbans.index') }}" class="btn btn-secondary ">Quay lại</a>
                                <input type="submit" value="Xác nhận" class="btn btn-primary" name="btAdd" id="btAddPhongBan">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>

        <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
        <script>
            $('#errorTenPhongBan').hide();
            $('#errorMaPhongBan').hide();
            $('#formPhongBan').validate({
                rules:{
                    maPhongBan:{
                        required: true
                    },
                    tenPhongBan:{
                        required: true
                    }
                }
                ,messages:{
                    maPhongBan: {
                        required: "Vui lòng nhập mã phòng ban"
                    },
                    tenPhongBan: {
                        required: "Vui lòng nhập tên phòng ban"
                    },
                }
            });
            $(document).on('keyup', '#maPhongBan', function(){
                $.ajax({
                    url: '{{ route("check_maPhongBan_unique") }}',
                    type: 'get',
                    data: {
                        '_token': $('meta[name="csrf-token"]').attr('content'),
                        maPhongBan: function(){
                            return $('#maPhongBan').val();
                        }
                    },
                    success: function(response){
                        if(response == 'true'){
                            $("#errorMaPhongBan").show();
                        }else{
                            $("#errorMaPhongBan").hide();
                        }
                    }
                })
            });

            $(document).on('keyup', '#tenPhongBan', function(){
                $.ajax({
                    url: '{{ route("check_tenPhongBan_unique") }}',
                    type: 'get',
                    data: {
                        '_token': $('meta[name="csrf-token"]').attr('content'),
                        tenPhongBan: function(){
                            return $('#tenPhongBan').val();
                        }

                    },
                    success: function(response){
                        if(response == 'true'){
                            $("#errorTenPhongBan").show();
                        }else{
                            $("#errorTenPhongBan").hide();
                        }
                    }
                })
            });

            $(document).on('submit', '.formPhongBan', function(e) {
                e.preventDefault();
                if (!($("#errorMaPhongBan").is(":hidden")) || !($("#errorTenPhongBan").is(":hidden"))) {
                    toastr.warning('Kiểm tra lại dữ lại nhập', 'Thông báo');
                } else {
                    $.ajax({
                    url: "{{ route('phongbans.store') }}",
                    type: 'post',
                    data: $('.formPhongBan').serialize(),
                    success: function (response) {
                        $('#maPhongBan').val('');
                        $('#tenPhongBan').val('');
                        toastr.options = {
                        "closeButton": true,
                            "progressBar": true,
                            "positionClass": "toast-bottom-right",
                        }
                        toastr.success('Thêm mới phòng ban thành công', 'Thông báo');
                    },
                    })   
                }
            });
        </script>

        @endsection
</x-app-layout>
