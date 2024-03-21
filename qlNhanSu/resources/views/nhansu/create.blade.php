<x-app-layout>
    @extends('header')
        @section('main-content')
        <section class="content bg-white" style="">
            <h1 class="text-center text-dark">Thêm nhân sự</h1>

            <div class="container-fluid col-8">
                <div class="row">
                    <div class="col-sm">
                        <form id="formNhansu" enctype="multipart/form-data" method="post" action="" class="mt-2 formNhansu">
                            @csrf

                            <div class="input-group mt-3 mb-3">
                                <label class="input-group-text" for="">Mã nhân sự:</label>
                                <input class="form-control pt90" type="text" name="Manhansu" id="Manhansu" value="{{ old('Manhansu') }}" placeholder="(*)">
                            </div>

                            <div class="input-group mt-3 mb-3">
                                <label class="input-group-text" for="">Họ tên:</label>
                                <input class="form-control pt90" type="text" name="Hoten" id="Hoten" value="{{ old('Hoten') }}" placeholder="(*)">
                                <span class="error" id="error_Hoten">Họ tên không bao gồm các kí tự đặc biệt</span>
                            </div>

                            <div class="input-group mt-3 mb-3">
                                <label class="input-group-text" for="">Ngày sinh:</label>
                                <input class="form-control pt90" type="date" name="Ngaysinh" id="Ngaysinh" value="{{ old('Ngaysinh') }}" placeholder="(*)">
                                <span class="error spanErrorNgay" id="spanErrorNgay">Ngày bắt đầu không được nhỏ hơn ngày sinh</span>
                            </div>

                            <div class="input-group mt-3 mb-3">
                                <label class="input-group-text" for="">Giới tính:</label>
                                <label class="mt-2 mx-3">
                                    <input type="radio" name="Gioitinh" value="1" checked>
                                    Nam
                                </label>
                                <label class="mt-2 mx-3">
                                    <input type="radio" name="Gioitinh" value="0">
                                    Nữ
                                </label>
                            </div>

                            <div class="input-group mt-3 mb-3">
                                <label class="input-group-text" for="">CCCD:</label>
                                <input class="form-control pt90" name="CCCD" id="CCCD" value="{{ old('CCCD') }}" placeholder="(*)">
                            </div>

                            <div class="input-group mt-3 mb-3">
                                <label class="input-group-text" for="">Ngày bắt đầu:</label>
                                <input class="form-control pt90" type="date" name="Ngaybatdau" id="Ngaybatdau" value="{{ old('Ngaybatdau') }}" placeholder="(*)">
                                <span class="error spanErrorNgay" id="spanErrorNgay">Ngày bắt đầu không được nhỏ hơn ngày sinh</span>
                            </div>

                            <div class="input-group mt-3 mb-3">
                                <label class="input-group-text" for="">Địa chỉ:</label>
                                <input class="form-control pt90" type="text" name="Diachi" id="Diachi" value="{{ old('Diachi') }}">
                            </div>

                            <div class="input-group mt-3 mb-3">
                                <label class="input-group-text" for="">Số điện thoại:</label>
                                <input class="form-control pt90" type="text" name="SDT" id="SDT" value="{{ old('SDT') }}" placeholder="(*)">
                            </div>

                            <div class="input-group mt-3 mb-3">
                                <label class="input-group-text" for="">Quê quán:</label>
                                <input class="form-control pt90" type="text" name="Quequan" id="Quequan" value="{{ old('Quequan') }}">
                            </div>

                            <div class="mt-3 mb-3 d-flex justify-around">
                                <div class="input-group">
                                    <label class="input-group-text" for="">Phòng ban:</label>
                                    <select name="Maphongban" id="Maphongban">
                                        @foreach ($phongbans as $phongban)
                                            <option value="{{ $phongban->id }}">
                                                {{ $phongban->tenPhongBan }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="input-group">
                                    <label class="input-group-text" for="">Chức vụ:</label>
                                    <select name="MaChucVu" id="MaChucVu">
                                        @foreach ($chucvus as $chucvu)
                                            <option value="{{ $chucvu->id }}">
                                                {{ $chucvu->tenChucVu }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="mt-3 mb-3 d-flex justify-around">
                                <div class="input-group">
                                    <label class="input-group-text" for="">Khoa:</label>
                                    <select name="Makhoa" id="Makhoa">
                                        @foreach ($khoas as $khoa)
                                            <option value="{{ $khoa->id }}">
                                                {{ $khoa->tenKhoa }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="input-group">
                                    <label class="input-group-text" for="">Bậc lương:</label>
                                    <select name="Bacluong" id="Bacluong">
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                    </select>
                                </div>
                                {{-- <div class="input-group d-flex">
                                    <label class="input-group-text" style="margin-left: 20px" for="">Hệ số lương:</label>
                                    <input type="text" class="form-control" style="background: white" readonly>
                                </div> --}}
                            </div>

                            <div class="input-group mt-3 mb-3">
                                <label class="input-group-text" for="">Ảnh đại diện:</label>
                                <input class="form-control pt90" type="file" name="Anhdaidien" id="Anhdaidien" value="{{ old('Anhdaidien') }}">
                                <span class="error" id="spanErrorAnhdaidien">Chỉ chấp nhận các tệp ảnh PNG hoặc JPEG</span>
                            </div>

                            <div class="input-group mt-3 mb-3">
                                <label class="input-group-text" for="">Email:</label>
                                <input class="form-control pt90" type="email" name="email" id="email" value="{{ old('email') }}" placeholder="(*)">
                            </div>

                            <div class="form-group  float-end ">
                                <a href="{{ route('nhansus.index') }}" class="btn btn-secondary ">Quay lại</a>
                                <input type="submit" value="Xác nhận" class="btn btn-primary" name="btAdd" id="btAddnhansu">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
        @endsection

        <script src="https://cdn.jsdelivr.net/jquery.validation/1.15.1/jquery.validate.min.js"></script>
        <script>window.baseUrl = "{{ URL::to('/') }}";</script>
        <script src="{{ asset('assets') }}/js/app.js"></script>
        <script>
            toastr.options = {
                "closeButton": true,
                "progressBar": true,
                "positionClass": "toast-bottom-right",
            }
            $('#error_Hoten').hide();
            $('#spanErrorAnhdaidien').hide();
            $('.spanErrorNgay').hide();
            $('#formNhansu').validate({
                rules:{
                    Manhansu:{
                        required: true
                    },
                    account:{
                        required: true
                    },
                    email:{
                        required: true,
                        email: true
                    },
                    CCCD: {
                        required: true,
                        digits: true,
                        minlength: 12,
                        maxlength: 12
                    },
                    Hoten: {
                        required: true,
                    },
                    SDT: {
                        required: true,
                        minlength: 10,
                        maxlength: 10,
                        digits: true
                    },
                    Ngaysinh: {
                        required: true,
                        date: true
                    },
                    Ngaybatdau: {
                        required: true,
                        date: true
                    }
                },
                messages:{
                    Manhansu: {
                        required: "Trường mã nhân sự không được để trống"
                    },
                    account: {
                        required: "Trường tài khoản không được để trống"
                    },
                    email: {
                        required: "Trường email không được để trống",
                        email: "Vui lòng nhập đúng định dạng email"
                    },
                    CCCD: {
                        required: "Trường CCCD không được để trống",
                        digits: "CCCD chỉ bao gồm các số",
                        minlength: "CCCD phải có 12 chữ số",
                        maxlength: "CCCD phải có 12 chữ số"
                    },
                    Hoten: {
                        required: "Trường họ tên không được để trống",
                    },
                    SDT: {
                        required: "Trường số điện thoại không được để trống",
                        minlength: "Số điện thoại phải có 10 chữ số",
                        maxlength: "Số điện thoại phải có 10 chữ số",
                        digits: "Vui lòng chỉ nhập số"
                    },
                    Ngaysinh: {
                        required: "Hãy chọn ngày sinh",
                        date: "Vui lòng nhập đúng định dạng ngày"
                    },
                    Ngaybatdau: {
                        required: "Hãy chọn ngày bắt đầu",
                        date: "Vui lòng nhập đúng định dạng ngày"
                    }
                },
                invalidHandler: function(event, validator) {
                    if (validator.numberOfInvalids() > 0) {
                        toastr.warning('Vui lòng kiểm tra lại thông tin vừa nhập', 'Thông báo');
                        event.preventDefault();
                    }
                },
            });
            $('#Anhdaidien').change(function() {
                var fileName = $(this).val();
                var extension = fileName.split('.').pop().toLowerCase();
                if ($.inArray(extension, ['png', 'jpg', 'jpeg']) == -1) {
                    $('#spanErrorAnhdaidien').show()
                    $(this).val('');
                }else{
                    $('#spanErrorAnhdaidien').hide();
                }
            });

            $(document).on('change', function() {
                var ngaybatdau = $('#Ngaybatdau').val();
                var ngaysinh = $('#Ngaysinh').val();
                var hoten = $('#Hoten').val();

                if (hoten.length > 0){
                    var kTraHoten = /^[a-zA-Z\s]+$/;
                    if(kTraHoten.test(hoten) == false){
                        $('#error_Hoten').show();
                    }else{
                        $('#error_Hoten').hide();
                    }
                }

                if(ngaybatdau != '' && ngaysinh != ''){
                    if (ngaybatdau < ngaysinh) {
                        $('.spanErrorNgay').show();
                        $(this).val('');
                    }else{
                        $('.spanErrorNgay').hide();
                    }
                }
            });

            $(document).on('submit', '.formNhansu', function(e) {
                e.preventDefault();
                var ngaybatdau = $('#Ngaybatdau').val();
                var ngaysinh = $('#Ngaysinh').val();
                const formCreateNhansu = new FormData(this);
                $.ajax({
                    url: "{{ route('nhansus.store') }}",
                    type: 'post',
                    data: formCreateNhansu,
                    cache: false,
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    success: function (response) {
                        $('#Manhansu').val('');
                        $('#Hoten').val('');
                        $('#Ngaysinh').val('');
                        $('input[name="Gioitinh"]').prop('checked', false);
                        $('#CCCD').val('');
                        $('#Ngaybatdau').val('');
                        $('#Diachi').val('');
                        $('#SDT').val('');
                        $('#Quequan').val('');
                        $('#Anhdaidien').val('');
                        $('#email').val('');
                        toastr.success('Thêm nhân sự mới thành công', 'Thông báo');
                    },
                    error: function (error) {
                        toastr.warning('Vui lòng kiểm tra lại thông tin vừa nhập', 'Thông báo');
                    }
                })
            })
        </script>
</x-app-layout>
