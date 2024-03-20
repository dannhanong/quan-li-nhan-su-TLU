<x-app-layout>
    @extends('header')
        @section('main-content')
        <section class="content bg-white" style="min-height: 85vh">
            <h1 class="text-center text-dark">Thêm khen thưởng</h1>

            <div class="container-fluid col-8">
                <div class="row">
                    <div class="col-sm">
                        <form id="formKhenthuong" method="post" action="{{ route('khenthuongs.store') }}" class="m-5 mt-2 formKhenthuong">
                            @csrf

                            <div class="input-group mt-3 mb-3">
                                <label class="input-group-text" for="">Mã nhân sự:</label>
                                <input type="text" name="Manhansu" id="Manhansu" class="form-control typeahead" autocomplete="off">
                                <span id="errorManhansu" class="error" style="display: none">Mã nhân sự không tồn tại</span>
                                <span id="errorManhansurequired" class="error" style="display: none">Vui lòng nhập mã nhân sự</span>
                            </div>

                            <div class="input-group mt-3 mb-3">
                                <label class="input-group-text" for="">Ngày khen thưởng:</label>
                                <input class="form-control pt90" type="date" name="ngayKhenThuong" id="ngayKhenThuong" value="{{ old('ngayKhenThuong', now()->toDateString()) }}" placeholder="(*)">
                                <span id="errorngayKhenThuong" class="error" style="display: none">Ngày khen thưởng phải sau ngày sinh</span>
                            </div>

                            <div class="">
                                <label class="input-group-text" for="">Lý do:</label>
                                <textarea class="form-control" name="lyDo" id="lyDo" value="{{ old('lyDo') }}" placeholder="(*)" rows="2"></textarea>
                            </div>

                            <div class="input-group mt-3 mb-3">
                                <label class="input-group-text" for="">Chi tiết khen thưởng:</label>
                                <input class="form-control pt90" name="chiTietKhenThuong" id="chiTietKhenThuong" value="{{ old('chiTietKhenThuong') }}" placeholder="(*)">
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
          
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js" ></script>
        <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
        <script>
            $('#formKhenthuong').validate({
                rules:{
                    ngayKhenThuong:{
                        required: true
                    },
                    lyDo:{
                        required: true,
                        specialChars: true
                    },
                    chiTietKhenThuong:{
                        required: true,
                        specialChars: true
                    }
                },
                messages:{
                    ngayKhenThuong:{
                        required: 'Vui lòng nhập ngày khen thường',
                    },
                    lyDo:{
                        required: 'Vui lòng nhập lý do khen thường',
                        specialChars: 'Vui lòng không nhập ký tự đặc biệt'
                    },
                    chiTietKhenThuong:{
                        required: 'Vui lòng nhập chi tiết khen thường',
                        specialChars: 'Vui lòng không nhập ký tự đặc biệt'
                    }
                },
            });

            $.validator.addMethod("specialChars", function (value, element) {
                return /^[a-zA-Z0-9À-ỹ\s]+$/.test(value);
            });

            $('#Manhansu').typeahead({
                source: function (query, process) {
                    return $.ajax({
                        url: "{{ route('get_Manhansu_list') }}", 
                        type: 'get',
                        data: { query: query },
                        dataType: 'json',
                        success: function (data) {
                            return process(data);
                        }
                    });
                },
                updater: function (item) {
                    var selectedManhansu = item.split(' ')[0];
                    $('#Manhansu').val(selectedManhansu);
                    return selectedManhansu;
                },
                minLength: 1, 
            });
            
            $(document).on('click', '#ngayKhenThuong, #lyDo, #chiTietKhenThuong, #formKhenthuong [type="submit"], .dropdown-item', function(){
                if ($('#Manhansu').val().length > 0) {
                $.ajax({
                    url: '{{ route("check_Manhansu_exists") }}',
                    type: 'get',
                    data: {
                        '_token': $('meta[name="csrf-token"]').attr('content'),
                        Manhansu: function(){
                            return $('#Manhansu').val();
                        }
                    },
                    success: function(response){
                        if(response == 'true'){
                            $("#errorManhansurequired").hide();
                            $("#errorManhansu").hide();
                        } else {
                            $("#errorManhansurequired").hide();
                            $("#errorManhansu").show();
                        }
                    }
                })
                } else{
                    $("#errorManhansu").hide();
                    $("#errorManhansurequired").show();
                }
            });

            $(document).on('click', '#Manhansu, #ngayKhenThuong, #lyDo, #chiTietKhenThuong, #formKhenthuong [type="submit"], .dropdown-item', function(){
                if($('#Manhansu').val() && $('#ngayKhenThuong').val()){
                $.ajax({
                    url: '{{ route("check_ngayKhenThuong") }}',
                    type: 'get',
                    data: {
                        '_token': $('meta[name="csrf-token"]').attr('content'),
                        Manhansu: $('#Manhansu').val(),
                        ngayKhenThuong: $('#ngayKhenThuong').val()
                    },
                    success: function(response){
                        if(response == 'true'){
                            $("#errorngayKhenThuong").hide();
                        } else {
                            $("#errorngayKhenThuong").show();
                        }
                    }
                })
                }
            });

            $(document).on('submit', '.formKhenthuong', function(e) {
                e.preventDefault();     
                $.ajax({
                    url: "{{ route('khenthuongs.store') }}",
                    type: 'post',
                    data: $('.formKhenthuong').serialize(),
                    success: function (response) {
                        $('#ngayKhenThuong').val('');
                        $('#lyDo').val('');
                        $('#chiTietKhenThuong').val('');
                        $('#Manhansu').val('');
                        toastr.options = {
                            "closeButton": true,
                            "progressBar": true,
                            "positionClass": "toast-bottom-right",
                        }
                        toastr.success('Thêm mới khen thưởng thành công', 'Thông báo');
                    },
                    error: function (xhr, status, error) {
                        toastr.options = {
                                "closeButton": true,
                                "progressBar": true,
                                "positionClass": "toast-bottom-right",
                        }
                        if (xhr.status == 400) {
                            toastr.error('Đã xảy ra lỗi. Bản ghi đã tồn tại.', 'Thông báo');
                        } else {
                            toastr.error('Đã xảy ra lỗi. Kiểm tra lại dữ liệu đã nhập.', 'Thông báo');
                        }
                    },
                });
            });

        </script>

        @endsection
</x-app-layout>
