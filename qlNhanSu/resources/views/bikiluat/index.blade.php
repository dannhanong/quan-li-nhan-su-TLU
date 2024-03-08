<x-app-layout>
    @extends('header')
        @section('tit')
            Quản lý tài khoản
        @endsection
        {{-- css tb --}}
        @push('css')

        <link href="https://cdn.datatables.net/2.0.1/css/dataTables.dataTables.min.css" rel="stylesheet">
        <link href="https://cdn.datatables.net/buttons/3.0.0/css/buttons.dataTables.min.css" rel="stylesheet">
        <link href="https://cdn.datatables.net/datetime/1.5.2/css/dataTables.dateTime.min.css" rel="stylesheet">

        <link href="https://cdn.datatables.net/datetime/1.5.2/css/dataTables.dateTime.min.css" rel="stylesheet">
        <link href="https://cdn.datatables.net/select/2.0.0/css/select.dataTables.min.css" rel="stylesheet">
        <link href="https://cdn.datatables.net/autofill/2.7.0/css/autoFill.dataTables.css" rel="stylesheet">
        @endpush

        {{-- js tb --}}
        @push('js')

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
        <script src="https://cdn.datatables.net/2.0.1/js/dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/3.0.0/js/dataTables.buttons.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/3.0.0/js/buttons.colVis.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/3.0.0/js/buttons.html5.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/3.0.0/js/buttons.print.min.js"></script>
        <script src="https://cdn.datatables.net/datetime/1.5.2/js/dataTables.dateTime.min.js"></script>
        <script src="https://cdn.datatables.net/autofill/2.7.0/js/dataTables.autoFill.min.js"></script>
        <script src="https://cdn.datatables.net/select/2.0.0/js/dataTables.select.min.js"></script>

        @endpush

        @section('main-content')
        <section class="content">
            <div class="container mt-4">

                <div class="container">
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-6">
                                    <h3>Danh sách nhân viên bị kỉ luật</h3>
                                </div>

                                <div class="col-md-6">
                                    <a href="{{ route('kiluats.create') }}" class="btn btn-primary float-end">Thêm mới</a>
                                </div>
                            </div>
                        </div>

                        <div class="row card-body table-data">

                        </div>

                        {{-- Modal edit --}}
                        <div class="modal fade" id="editKiLuatModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Chỉnh sửa nhân viên bị kỉ luật</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                                </div>
                                <div class="modal-body">
                                    <form method="post" action="" class="m-5 mt-2 formEditKiluat" id="formEditKiluat">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="id" id="id">
                                        <input type="hidden" name="maKiLuatF" id="maKiLuatF">

                                        <div class="input-group mt-3 mb-3">
                                            <label class="input-group-text" for="">Mã kỉ luật:</label>
                                            <input class="form-control" type="text" name="maKiLuat" id="maKiLuat" placeholder="(*)">
                                            <span id="errorMaKiLuat" class="error">Mã kỉ luật đã tồn tại</span>
                                        </div>

                                        <div class="input-group mt-3 mb-3">
                                            <label class="input-group-text" for="">Tên kỉ luật:</label>
                                            <input class="form-control" name="tenKiLuat" id="tenKiLuat" placeholder="(*)">
                                            <span id="errortenKiLuat" class="error">Tên kỉ luật đã tồn tại</span>
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
                        <div class="modal fade" id="deletekiluatModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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

                                <form id="formDeleteKiluat" class="formDeleteKiluat" action="" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-primary" id="btnSubmit">Xác nhận</button>
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
                                    <div class="mb-3"><span class="spanBold">Bậc lương: </span><span id="spanBacluong"></span></div>
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
            $('#errorMaKiLuat').hide();
            $('#errortenKiLuat').hide();
            $('#formEditKiluat').validate({
                rules:{
                    maKiLuat:{
                        required: true
                    },
                    tenKiLuat:{
                        required: true
                    }
                }
                ,messages:{
                    maKiLuat: {
                        required: "Vui lòng nhập mã kỉ luật"
                    },
                    tenKiLuat: {
                        required: "Vui lòng nhập tên kỉ luật"
                    },
                }
            });

            $(document).on('keyup', '#maKiLuat', function(){
                $.ajax({
                    url: '{{ route("check_maKiLuat_unique") }}',
                    type: 'get',
                    data: {
                        maKiLuatF: function(){
                            return $('#maKiLuatF').val();
                        },
                        '_token': $('meta[name="csrf-token"]').attr('content'),
                        maKiLuat: function(){
                            return $('#maKiLuat').val();
                        }
                    },
                    success: function(response){
                        if(response == 'true'){
                             $('#errorMaKiLuat').show();
                        }else{
                             $('#errorMaKiLuat').hide();
                        }
                    }
                })
            });

            $(document).on('keyup', '#tenKiLuat', function(){
                $.ajax({
                    url: '{{ route("check_tenKiLuat_unique") }}',
                    type: 'get',
                    data: {
                        '_token': $('meta[name="csrf-token"]').attr('content'),
                        tenKiLuat: function(){
                            return $('#tenKiLuat').val();
                        }
                    },
                    success: function(response){
                        if(response == 'true'){
                             $('#errortenKiLuat').show();
                        }else{
                             $('#errortenKiLuat').hide();
                        }
                    }
                })
            });

            $(function() {
                fetchAllKiLuat();
                toastr.options = {
                "closeButton": true,
                "progressBar": true,
                "positionClass": "toast-bottom-right",
            };

            $(document).on('click', '#aEditkiluat', function(e) {
                let id = $(this).data('id_edit');
                $.ajax({
                    url: '{{ route("kiluats.edit", ":id") }}'.replace(':id', id),
                    type: 'get',
                    data: {
                        id: id,
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response){
                        $('#id').val(response.id);
                        $('#maKiLuat').val(response.maKiLuat);
                        $('#tenKiLuat').val(response.tenKiLuat);
                        $('#maKiLuatF').val(response.maKiLuat);
                    }
                })
            });

            $(document).on('click', '#aShowkiluat', function(){
                let id = $(this).data('id_show');
                $.ajax({
                    url: '{{ route("bikiluats.show", ":id") }}'.replace(':id', id),
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
                        $('#spanBacluong').text(response.Bacluong);
                        $('#spanEmail').text(response.email);

                        var formattedCreate = moment(response.created_at).format('DD/MM/YYYY HH:mm:ss');
                        $('#spanCreateAt').text(formattedCreate);
                        var formattedUpdate = moment(response.updated_at).format('DD/MM/YYYY HH:mm:ss');
                        $('#spanUpdateAt').text(formattedUpdate);
                    }
                })
            });

            $(document).on('click', '#aDeletekiluat', function(e){
                let id = $(this).data('id_xoa');
                $.ajax({
                    url: '{{ route("bikiluats.edit", ":id") }}'.replace(':id', id),
                    type: 'get',
                    data:{
                        id: id,
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response){
                        var tenKiLuat = response.tenKiLuat;
                        $('#id').val(response.id);
                        $('#tb').text("Bạn chắc chắn muốn xóa?");
                    }
                })
            });

            $(document).on('submit', '#formEditKiluat', function(e){
                e.preventDefault();
                let id = $('#id').val();
                $.ajax({
                    url: '{{ route("kiluats.update", ":id") }}'.replace(':id', id),
                    type: 'post',
                    data: $('#formEditKiluat').serialize(),
                    success: function(response){
                        toastr.success('Cập nhật thông tin kỉ luật thành công', 'Thông báo');
                        fetchAllKiLuat();
                        $('#formEditKiluat')[0].reset();
                        $('.fade').hide();
                    },
                    error: function(){
                        toastr.error('Có lỗi xảy ra', 'Thông báo');
                    }
                })
            });

            $(document).on('submit', '#formDeleteKiluat', function(e){
                e.preventDefault();
                let id = $('#id').val();
                $.ajax({
                    url: '{{ route("bikiluats.destroy", ":id") }}'.replace(':id', id),
                    type: 'delete',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response){
                        toastr.success('Xóa thành công', 'Thông báo');
                        $('#formDeleteKiluat')[0].reset();
                        fetchAllKiLuat();
                        $('.fade').hide();
                    }
                })
            });

            function fetchAllKiLuat(){
                    $.ajax({
                        url: "{{ route('bikiluats.fetch') }}",
                        type: 'get',
                        success: function(response){
                            $('.table-data').html(response);
                            $('#phongbanTable').DataTable({
                                select: true,
                                language: {
                                    emptyTable:     "Không có dữ liệu nào được tìm thấy",
                                    zeroRecords:    "Không có kết quả nào phù hợp được tìm thấy",
                                    info:           "",
                                    infoEmpty:      "",
                                    infoFiltered:   "(được lọc từ tổng số _MAX_ mục)",
                                    search:         "",
                                },
                                dom: 'lBrpf',
                                // pagingType: 'numbers',
                                order: [0, 'asc'],
                                columnDefs: [
                                    {
                                        data: 'Thao tác',
                                        className: 'not-exp',
                                        targets: [3]
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


