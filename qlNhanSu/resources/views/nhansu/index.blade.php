<x-app-layout>
    @extends('header')
        @section('tit')
            Quản lý nhân sự
        @endsection
        {{-- css tb --}}
        @push('css')
        {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/css/jquery.dataTables.min.css"
        integrity="sha512-1k7mWiTNoyx2XtmI96o+hdjP8nn0f3Z2N4oF/9ZZRgijyV4omsKOXEnqL1gKQNPy2MTSP9rIEWGcH/CInulptA=="
        crossorigin="anonymous"
        referrerpolicy="no-referrer"/> --}}

        <link href="https://cdn.datatables.net/2.0.1/css/dataTables.dataTables.min.css" rel="stylesheet">
        <link href="https://cdn.datatables.net/buttons/3.0.0/css/buttons.dataTables.min.css" rel="stylesheet">
        <link href="https://cdn.datatables.net/datetime/1.5.2/css/dataTables.dateTime.min.css" rel="stylesheet">

        <link href="https://cdn.datatables.net/datetime/1.5.2/css/dataTables.dateTime.min.css" rel="stylesheet">
        <link href="https://cdn.datatables.net/select/2.0.0/css/select.dataTables.min.css" rel="stylesheet">
        <link href="https://cdn.datatables.net/autofill/2.7.0/css/autoFill.dataTables.css" rel="stylesheet">
        @endpush

        {{-- js tb --}}
        @push('js')
        {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/js/jquery.dataTables.min.js"
        integrity="sha512-BkpSL20WETFylMrcirBahHfSnY++H2O1W+UnEEO4yNIl+jI2+zowyoGJpbtk6bx97fBXf++WJHSSK2MV4ghPcg=="
        crossorigin="anonymous"
        referrerpolicy="no-referrer"></script> --}}

        <script src="https://cdn.datatables.net/2.0.1/js/dataTables.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
        <script src="https://cdn.datatables.net/buttons/3.0.0/js/dataTables.buttons.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/3.0.0/js/buttons.colVis.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/3.0.0/js/buttons.html5.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/3.0.0/js/buttons.print.min.js"></script>
        <script src="https://cdn.datatables.net/datetime/1.5.2/js/dataTables.dateTime.min.js"></script>
        <script src="https://cdn.datatables.net/autofill/2.7.0/js/dataTables.autoFill.min.js"></script>
        <script src="https://cdn.datatables.net/select/2.0.0/js/dataTables.select.min.js"></script>

        {{-- <script src="https://cdn.datatables.net/autofill/2.7.0/js/dataTables.autoFill.min.js"></script> --}}
        {{-- <script src="//cdn.datatables.net/buttons/2.3.6/js/dataTables.buttons.min.js"></script>
        <script src="//cdn.datatables.net/buttons/2.3.6/js/buttons.html5.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js" integrity="sha512-XMVd28F1oH/O71fzwBnV7HucLxVwtxf26XV8P4wPk26EDxuGZ91N8bsOttmnomcCD3CS5ZMRL50H0GgOHvegtg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.70/pdfmake.min.js" integrity="sha512-HLbtvcctT6uyv5bExN/qekjQvFIl46bwjEq6PBvFogNfZ0YGVE+N3w6L+hGaJsGPWnMcAQ2qK8Itt43mGzGy8Q==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.70/vfs_fonts.js" integrity="sha512-vv3EN6dNaQeEWDcxrKPFYSFba/kgm//IUnvLPMPadaUf5+ylZyx4cKxuc4HdBf0PPAlM7560DV63ZcolRJFPqA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> --}}
        @endpush

        @section('main-content')
            <section class="content">
                <div class="container mt-4">

                    <div class="container">
                        <div class="card">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h3>Danh sách nhân sự</h3>
                                    </div>

                                    <div class="col-md-6">
                                        <a href="{{ route('nhansu_Nghihuu') }}" style="margin-left: 20%" class="btn btn-danger">Danh sách nghỉ hưu</a>
                                        <a href="{{ route('nhansus.create') }}" class="btn btn-primary float-end">Thêm mới</a>
                                    </div>

                                </div>
                            </div>

                            <div class="mx-3 mt-1 d-flex justify-between">
                                <div class="d-flex" style="max-height: 40px;">
                                    <label class="input-group-text" for="">Phòng ban:</label>
                                    <select name="MaphongbanF" id="MaphongbanF">
                                        <option value="">Chọn phòng ban...</option>
                                        @foreach ($phongbans as $phongban)
                                            <option value="{{ $phongban->id }}">
                                                {{ $phongban->tenPhongBan }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="d-flex" style="max-height: 40px;">
                                    <label class="input-group-text" for="">Chức vụ:</label>
                                    <select name="MaChucVuF" id="MaChucVuF">
                                        <option value="">Chọn chức vụ...</option>
                                        @foreach ($chucvus as $chucvu)
                                            <option value="{{ $chucvu->id }}">
                                                {{ $chucvu->tenChucVu }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="d-flex" style="max-height: 40px;">
                                    <label class="input-group-text" for="">Khoa:</label>
                                    <select name="MakhoaF" id="MakhoaF">
                                        <option value="">Chọn khoa...</option>
                                        @foreach ($khoas as $khoa)
                                            <option value="{{ $khoa->id }}">
                                                {{ $khoa->tenKhoa }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div>
                                    <button class="mx-2" id="btn_Refesh"><i class="fa-solid fa-arrows-rotate"></i></button>
                                    <button type="button" class="btn btn-outline-primary filter-button" id="filter-button">Lọc</button>
                                </div>
                            </div>

                            <div class="row card-body table-data">

                            </div>

                            {{-- Modal edit --}}
                            <div class="modal fade" id="editNhansuModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document" style="max-width: 70%;">
                                <div class="modal-content">
                                    <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Chỉnh sửa nhân sự</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                    </div>
                                    <div class="modal-body">
                                        <form enctype="multipart/form-data" method="post" action="" class="m-5 mt-2 formEditNhansu" id="formEditNhansu">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="id" id="id">
                                            <input type="hidden" name="u_Anhdaidien" id="u_Anhdaidien">

                                            <div class="d-flex">
                                                <div class="mt-2" style="margin-right: 10%" id="Anhdaidien"></div>

                                                <div class="input-group">
                                                    <div class="input-group mt-3 mb-3">
                                                        <label class="input-group-text" for="">Mã nhân sự:</label>
                                                        <input class="form-control pt90" type="text" name="Manhansu" id="Manhansu" value="{{ old('Manhansu') }}">
                                                    </div>

                                                    <div class="input-group mt-3 mb-3">
                                                        <label class="input-group-text" for="">Họ tên:</label>
                                                        <input class="form-control pt90" type="text" name="Hoten" id="Hoten" value="{{ old('Hoten') }}">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="input-group mt-3 mb-3">
                                                <label class="input-group-text" for="">Ngày sinh:</label>
                                                <input class="form-control pt90" type="date" name="Ngaysinh" id="Ngaysinh" value="{{ old('Ngaysinh') }}" placeholder="(*)">
                                            </div>

                                            <div class="input-group mt-3 mb-3">
                                                <label class="input-group-text" for="">Giới tính:</label>
                                                <label class="mt-2 mx-3">
                                                    <input type="radio" name="Gioitinh" value="1">
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
                                            {{-- </div> --}}

                                            {{-- <div class="input-group mt-3 mb-3"> --}}
                                                <label class="input-group-text" style="margin-left: 10%" for="">Ngày bắt đầu:</label>
                                                <input class="form-control pt90" type="date" name="Ngaybatdau" id="Ngaybatdau" value="{{ old('Ngaybatdau') }}" placeholder="(*)">
                                                <span class="error" id="spanErrorNgay" style="margin-left: 54%">Ngày bắt đầu không được nhỏ hơn ngày sinh</span>
                                            </div>

                                            <div class="input-group mt-3 mb-3">
                                                <label class="input-group-text" for="">Địa chỉ:</label>
                                                <input class="form-control pt90" type="text" name="Diachi" id="Diachi" value="{{ old('Diachi') }}" placeholder="(*)">
                                            </div>

                                            <div class="input-group mt-3 mb-3">
                                                <label class="input-group-text" for="">Số điện thoại:</label>
                                                <input class="form-control pt90" type="text" name="SDT" id="SDT" value="{{ old('SDT') }}" placeholder="(*)">
                                            </div>

                                            <div class="input-group mt-3 mb-3">
                                                <label class="input-group-text" for="">Quê quán:</label>
                                                <input class="form-control pt90" type="text" name="Quequan" id="Quequan" value="{{ old('Quequan') }}" placeholder="(*)">
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
                                                <div class="input-group">
                                                    <label class="input-group-text" for="">Trạng thái:</label>
                                                    <select name="Matrangthai" id="Matrangthai">
                                                        @foreach ($trangthais as $trangthai)
                                                            <option value="{{ $trangthai->id }}">
                                                                {{ $trangthai->tenTrangThai }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="input-group d-flex">
                                                    <label class="input-group-text" style="margin-left: 20px" for="">Hệ số lương:</label>
                                                    <input type="text" class="form-control" name="Hesoluong" id="Hesoluong" style="background: white" readonly>
                                                </div>
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

                                            <div class="form-group float-end">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                                                <input type="submit" name="btSave" value="Cập nhật" class="btn btn-primary">
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                </div>
                            </div>


                            <!-- Modal delete -->
                            <div class="modal fade" id="deleteNhansuModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Xác nhận xóa</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                    </div>
                                    <div class="modal-body">
                                        <span id="tb"></span>
                                    </div>
                                    <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>

                                    <form id="formDeleteNhansu" class="formDeleteNhansu" action="" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-primary" id="btnSubmit">Xác nhận</button>
                                    </form>
                                    </div>

                                </div>
                                </div>
                            </div>

                            <!-- Modal reti -->
                            <div class="modal fade" id="retiNhansuModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Xác nhận nghỉ hưu</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                    </div>
                                    <div class="modal-body">
                                        <span id="tbReti"></span>
                                    </div>
                                    <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>

                                    <form id="formRetiNhansu" class="formRetiNhansu" action="" method="POST">
                                        @csrf
                                        @method('GET')
                                        <button type="submit" class="btn btn-primary" id="btnSubmitReti">Xác nhận</button>
                                    </form>
                                    </div>

                                </div>
                                </div>
                            </div>

                            <!-- Modal show -->
                            <div class="modal fade" id="showNhansuModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                <h4 class="modal-title spanBold" id="exampleModalLabel">Thông tin chi tiết nhân sự</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="mb-3 display"><div class="mt-2" id="divAnhdaidien"></div><h4 class="spanBold mt-5 mx-3" id="h4Hoten"></h4></div>
                                        <div class="mb-3"><span class="spanBold">Mã nhân sự: </span><span id="spanManhansu"></span></div>
                                        <div class="mb-3"><span class="spanBold">Ngày sinh: </span><span id="spanNgaysinh"></span></div>
                                        <div class="mb-3"><span class="spanBold">Giới tính: </span><span id="spanGioitinh"></span></div>
                                        <div class="mb-3"><span class="spanBold">CCCD: </span><span id="spanCCCD"></span></div>
                                        <div class="mb-3"><span class="spanBold">Ngày bắt đầu: </span><span id="spanNgaybatdau"></span></div>
                                        <div class="mb-3"><span class="spanBold">Địa chỉ: </span><span id="spanDiachi"></span></div>
                                        <div class="mb-3"><span class="spanBold">Số điện thoại: </span><span id="spanSDT"></span></div>
                                        <div class="mb-3"><span class="spanBold">Quê quán: </span><span id="spanQuequan"></span></div>
                                        <div class="mb-3"><span class="spanBold">Phòng ban: </span><span id="spanPhongban"></span></div>
                                        <div class="mb-3"><span class="spanBold">Chức vụ: </span><span id="spanChucvu"></span></div>
                                        <div class="mb-3"><span class="spanBold">Khoa: </span><span id="spanKhoa"></span></div>
                                        <div class="mb-3"><span class="spanBold">Trạng thái: </span><span id="spanTrangthai"></span></div>
                                        <div class="mb-3"><span class="spanBold">Bậc lương: </span><span id="spanBacluong"></span></div>
                                        <div class="mb-3"><span class="spanBold">Hệ số lương: </span><span id="spanHeSoLuong"></span></div>
                                        <div class="mb-3"><span class="spanBold">Email cá nhân: </span><span id="spanEmail"></span></div>

                                        <div class="mb-3"><span class="spanBold">Thời gian tạo: </span><span id="spanCreateAt"></span></div>
                                        <div class="mb-3"><span class="spanBold">Lần cập nhật gần nhất: </span><span id="spanUpdateAt"></span></div>
                                    </div>
                                    <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                                    </div>
                                </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </section>
        @endsection

        <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>

        <script>
            $('#spanErrorAnhdaidien').hide();
            $('#spanErrorNgay').hide();
            $('#formEditNhansu').validate({
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
                        required: true
                    },
                    Hoten: {
                        required: true
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
                        required: "Trường CCCD không được để trống"
                    },
                    Hoten: {
                        required: "Trường họ tên không được để trống"
                    },
                    SDT: {
                        required: "Trường số điện thoại không được để trống",
                        minlength: "Số điện thoại phải chứa ít nhất 10 chữ số",
                        maxlength: "Số điện thoại chỉ được chứa tối đa 10 chữ số",
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
                if (ngaybatdau < ngaysinh) {
                    $('#spanErrorNgay').show();
                    $(this).val('');
                }else{
                    $('#spanErrorNgay').hide();
                }
            });

            $('#Ngaybatdau').on('change', function() {
                var ngaybatdau = $(this).val();

                if($('#Ngaysinh').val() !== null)
                    var ngaysinh = $('#Ngaysinh').val();
                    if (ngaybatdau < ngaysinh) {
                        $('#spanErrorNgay').show();
                        $(this).val('');
                    }else{
                        $('#spanErrorNgay').hide();
                    }
            });

            $(document).on('keyup', '#email', function(){
                $.ajax({
                    url: '{{ route("check_email_edit") }}',
                    type: 'get',
                    data: {
                            email: function(){
                                return $('#email').val();
                            },
                            '_token': $('meta[name="csrf-token"]').attr('content'),
                            emailF: function(){
                                return $('#emailF').val();
                            }
                        },
                    success: function(response){
                        if(response.status == false){
                            $('.sErrEmail').show();
                        }else if (response.status == true){
                            $('.sErrEmail').hide();
                        }
                    }
                })
            });

            $(function() {
                fetchAllNhansus();
                toastr.options = {
                "closeButton": true,
                "progressBar": true,
                "positionClass": "toast-bottom-right",
            };

            $(document).on('click', '#aEditNhansu', function(e) {
                let id = $(this).data('id_edit');
                $.ajax({
                    url: '{{ route("nhansus.edit", ":id") }}'.replace(':id', id),
                    type: 'get',
                    data: {
                        id: id,
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response){
                        if (response.Gioitinh == 1) {
                            $('input[name="Gioitinh"][value="1"]').prop('checked', true);
                        } else {
                            $('input[name="Gioitinh"][value="0"]').prop('checked', true);
                        }
                        $('#Anhdaidien').html(`<img src="/uploads/avatars/${response.Anhdaidien}" style="width: 100px;">`);
                        $('#Hoten').val(response.Hoten);
                        $('#Manhansu').val(response.Manhansu);
                        $('#Ngaysinh').val(response.Ngaysinh);
                        $('#CCCD').val(response.CCCD);
                        $('#Ngaybatdau').val(response.Ngaybatdau);
                        $('#Diachi').val(response.Diachi);
                        $('#SDT').val(response.SDT);
                        $('#Quequan').val(response.Quequan);
                        $('#Maphongban').val(response.Maphongban);
                        $('#MaChucVu').val(response.Machucvu);
                        $('#Makhoa').val(response.Makhoa);
                        $('#Bacluong').val(response.Bacluong);

                        let curentDate = new Date();
                        let bacluongDate = new Date(response.Ngaybatdau);
                        let diffYears = curentDate.getFullYear() - bacluongDate.getFullYear();
                        console.log(new Date(response.Ngaybatdau));

                        if (diffYears < 5) {
                            $('#Hesoluong').val("1");
                        } else if (diffYears <10){
                            $('#Hesoluong').val("1.5");
                        } else if (diffYears < 15) {
                            $('#Hesoluong').val("2");
                        } else if (diffYears < 20) {
                            $('#Hesoluong').val("2.5");
                        } else {
                            $('#Hesoluong').val("3");
                        }

                        $('#email').val(response.email);
                        $('#u_Anhdaidien').val(response.Anhdaidien);
                        $('#id').val(response.id);
                    }
                })
            });

            $(document).on('click', '#aShowNhansu', function(){
                let id = $(this).data('id_show');
                $.ajax({
                    url: '{{ route("nhansus.show", ":id") }}'.replace(':id', id),
                    type: 'get',
                    data: {
                        id: id,
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response){
                        var gt = response.Gioitinh;

                        var gioitinh = gt == 0 ? "Nữ" : "Nam";
                        $('#divAnhdaidien').html(`<img src="/uploads/avatars/${response.Anhdaidien}" style="width: 100px;">`);
                        $('#h4Hoten').text(response.Hoten);
                        $('#spanManhansu').text(response.Manhansu);
                        $('#spanNgaysinh').text(response.Ngaysinh);
                        $('#spanGioitinh').text(gioitinh);
                        $('#spanCCCD').text(response.CCCD);
                        $('#spanNgaybatdau').text(response.Ngaybatdau);
                        $('#spanDiachi').text(response.Diachi);
                        $('#spanSDT').text(response.SDT);
                        $('#spanQuequan').text(response.Quequan);
                        $.ajax({
                            url: '/get-ten-phongban',
                            method: 'POST',
                            data: {
                                id: response.Maphongban,
                                '_token': $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function(response) {
                                $('#spanPhongban').text(response.tenPhongBan);
                            }
                        });
                        $.ajax({
                            url: '/get-ten-chucvu',
                            method: 'POST',
                            data: {
                                id: response.Machucvu ,
                                '_token': $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function(response) {
                                $('#spanChucvu').text(response.tenChucVu);
                            }
                        });
                        $.ajax({
                            url: '/get-ten-khoa',
                            method: 'POST',
                            data: {
                                id: response.Makhoa ,
                                '_token': $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function(response) {
                                $('#spanKhoa').text(response.tenKhoa);
                            }
                        });

                        $.ajax({
                            url:'/get-ten-trangthai',
                            method: 'POST',
                            data: {
                                id: response.Matrangthai,
                                '_token': $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function(response) {
                                $('#spanTrangthai').text(response.tenTrangThai);
                            }
                        })
                        $('#spanBacluong').text(response.Bacluong);

                        let curentDate = new Date();
                        let bacluongDate = new Date(response.Ngaybatdau);
                        let diffYears = curentDate.getFullYear() - bacluongDate.getFullYear();
                        if (diffYears < 5) {
                            $('#spanHeSoLuong').text("1");
                        } else if (diffYears <10){
                            $('#spanHeSoLuong').text("1.5");
                        } else if (diffYears < 15) {
                            $('#spanHeSoLuong').text("2");
                        } else if (diffYears < 20) {
                            $('#spanHeSoLuong').text("2.5");
                        } else {
                            $('#spanHeSoLuong').text("3");
                        }

                        $('#spanEmail').text(response.email);

                        var formattedCreate = moment(response.created_at).format('DD/MM/YYYY HH:mm:ss');
                        $('#spanCreateAt').text(formattedCreate);
                        var formattedUpdate = moment(response.updated_at).format('DD/MM/YYYY HH:mm:ss');
                        $('#spanUpdateAt').text(formattedUpdate);
                    }
                })
            });

            $(document).on('click', '#aDeleteNhansu', function(e){
                let id = $(this).data('id_xoa');
                $.ajax({
                    url: '{{ route("nhansus.edit", ":id") }}'.replace(':id', id),
                    type: 'get',
                    data:{
                        id: id,
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response){
                        var tenNhansu = response.Hoten;
                        $('#id').val(response.id);
                        $('#tb').text("Bạn chắc chắn muốn xóa nhân sự: "+tenNhansu+"?");
                    }
                })
            });

            $(document).on('click', '#aRetiNhansu', function(e){
                let id = $(this).data('id_huu');
                $.ajax({
                    url: '{{ route("nhansus.edit", ":id") }}'.replace(':id', id),
                    type: 'get',
                    data:{
                        id: id,
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response){
                        var tenNhansu = response.Hoten;
                        $('#id').val(response.id);
                        $('#tbReti').text("Bạn chắc chắn muốn chuyển nhân sự: "+tenNhansu+" này sang thành nghỉ hưu?");
                    }
                })
            });

            $(document).on('submit', '#formEditNhansu', function(e){
                e.preventDefault();
                var ngaybatdau = $('#Ngaybatdau').val();
                var ngaysinh = $('#Ngaysinh').val();
                if (ngaybatdau < ngaysinh) {
                        $('#spanErrorNgay').show();
                        $(this).val('');
                    }else{
                        $('#spanErrorNgay').hide();
                }
                let id = $('#id').val();
                const formEditNhansu = new FormData(this);
                $.ajax({
                    url: '{{ route("nhansus.update", ":id") }}'.replace(':id', id),
                    type: 'post',
                    data: formEditNhansu,
                    cache: false,
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    success: function(response){
                        toastr.success('Cập nhật nhân sự thành công', 'Thông báo');
                        fetchAllNhansus();
                        $('#formEditNhansu')[0].reset();
                        $('.fade').hide();
                        fetchAllNhansus();
                    },
                    error: function(){
                        toastr.error('Có lỗi xảy ra', 'Thông báo');
                    }
                })
            });

            $(document).on('submit', '#formDeleteNhansu', function(e){
                e.preventDefault();
                let id = $('#id').val();
                $.ajax({
                    url: '{{ route("nhansus.destroy", ":id") }}'.replace(':id', id),
                    type: 'delete',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response){
                        toastr.success('Xóa nhân sự thành công', 'Thông báo');
                        $('#formDeleteNhansu')[0].reset();
                        fetchAllNhansus();
                        $('.fade').hide();
                    },
                    error: function(){
                        toastr.error('Có lỗi xảy ra', 'Thông báo');
                    }
                })
            });

            $(document).on('submit', '#formRetiNhansu', function(e){
                e.preventDefault();
                let id = $('#id').val();
                $.ajax({
                    url: '/nhansuNghihuu@:id"'.replace(':id', id),
                    type: 'get',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response){
                        toastr.success('Chuyển nhân sự thành công', 'Thông báo');
                        $('#formRetiNhansu')[0].reset();
                        fetchAllNhansus();
                        $('.fade').hide();
                    },
                    error: function(){
                        toastr.error('Có lỗi xảy ra', 'Thông báo');
                    }
                })
            });

            $('#filter-button').click(function() {
                var Maphongban = $('#MaphongbanF').val();
                var MaChucVu = $('#MaChucVuF').val();
                var Makhoa = $('#MakhoaF').val();
                $('#nhansuTable').DataTable().destroy();
                fetchFilterNhansus(Maphongban, MaChucVu, Makhoa);
            });

            $('#btn_Refesh').click(function() {
                $('#nhansuTable').DataTable().destroy();
                fetchAllNhansus();
            });

                function fetchAllNhansus(){
                    $.ajax({
                        url: "{{ route('nhansus.fetch') }}",
                        type: 'get',
                        success: function(response){
                            $('.table-data').html(response);
                            $('#nhansuTable').DataTable({
                                select: true,
                                language: {
                                    emptyTable:     "Không có dữ liệu nào được tìm thấy",
                                    zeroRecords:    "Không có kết quả nào phù hợp được tìm thấy",
                                    info:           "",
                                    infoEmpty:      "",
                                    infoFiltered:   "(được lọc từ tổng số _MAX_ mục)",
                                    search:         "",
                                },
                                dom: '<"H"lBrf><"clear">t<"F"p>',
                                responsive: true,
                                // pagingType: 'numbers',
                                order: [0, 'asc'],
                                columnDefs: [
                                    {
                                        data: 'Thao tác',
                                        className: 'not-exp',
                                        targets: [11]
                                    },
                                    {
                                        data: 'Ảnh đại diện',
                                        className: 'not-exp',
                                        targets: [2 ]
                                    }
                                ],

                                buttons: [
                                    {
                                        extend: 'copyHtml5',
                                        text: 'Copy',
                                        exportOptions: {
                                            columns: ':visible :not(.not-exp)'
                                        }
                                    },
                                    {
                                        extend: 'excelHtml5',
                                        text: 'Excel',
                                        exportOptions: {
                                            columns: ':visible :not(.not-exp)'
                                        }
                                    },
                                    {
                                        extend: 'csvHtml5',
                                        text: 'CSV',
                                        exportOptions: {
                                            columns: ':visible :not(.not-exp)'
                                        }
                                    },
                                    {
                                        extend: 'pdfHtml5',
                                        text: 'PDF',
                                        exportOptions: {
                                            columns: ':visible :not(.not-exp)'
                                        }
                                    },
                                    {
                                        extend: 'colvis',
                                        text: 'Các trường hiển thị'
                                    },
                                ],
                            });
                            $('.dt-length label').remove();
                            $('.dt-search input').attr('placeholder', 'Tìm kiếm');
                            $('#dt-length-1').prepend('<option value="5">5</option>');
                        }
                    })
                };

                function fetchFilterNhansus(phongban, chucvu, khoa){
                    $.ajax({
                        url: '/filter',
                        type: 'GET',
                        data: {
                            Maphongban: phongban,
                            MaChucVu: chucvu,
                            Makhoa: khoa
                        },
                        success: function(response){
                            $('.table-data').html(response);
                            $('#nhansuTable').DataTable({
                                select: true,
                                language: {
                                    emptyTable:     "Không có dữ liệu nào được tìm thấy",
                                    zeroRecords:    "Không có kết quả nào phù hợp được tìm thấy",
                                    info:           "",
                                    infoEmpty:      "",
                                    infoFiltered:   "(được lọc từ tổng số _MAX_ mục)",
                                    search:         "",
                                },
                                dom: '<"H"lBrf><"clear">t<"F"p>',
                                responsive: true,
                                // pagingType: 'numbers',
                                order: [0, 'asc'],
                                columnDefs: [
                                    {
                                        data: 'Thao tác',
                                        className: 'not-exp',
                                        targets: [10]
                                    },
                                    {
                                        data: 'Ảnh đại diện',
                                        className: 'not-exp',
                                        targets: [2 ]
                                    }
                                ],

                                buttons: [
                                    {
                                        extend: 'copyHtml5',
                                        text: 'Copy',
                                        exportOptions: {
                                            columns: ':visible :not(.not-exp)'
                                        }
                                    },
                                    {
                                        extend: 'excelHtml5',
                                        text: 'Excel',
                                        exportOptions: {
                                            columns: ':visible :not(.not-exp)'
                                        }
                                    },
                                    {
                                        extend: 'csvHtml5',
                                        text: 'CSV',
                                        exportOptions: {
                                            columns: ':visible :not(.not-exp)'
                                        }
                                    },
                                    {
                                        extend: 'pdfHtml5',
                                        text: 'PDF',
                                        exportOptions: {
                                            columns: ':visible :not(.not-exp)'
                                        }
                                    },
                                    {
                                        extend: 'colvis',
                                        text: 'Các trường hiển thị'
                                    },
                                ],
                            });
                            $('.dt-length label').remove();
                            $('.dt-search input').attr('placeholder', 'Tìm kiếm');
                            $('#dt-length-1').prepend('<option value="5">5</option>');
                        }
                    })
                };
            });

        </script>
</x-app-layout>


