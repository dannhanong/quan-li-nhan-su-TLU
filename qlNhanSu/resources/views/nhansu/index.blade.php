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
                                        <a href="{{ route('nhansus.create') }}" class="btn btn-primary float-end">Thêm mới</a>
                                    </div>

                                </div>
                            </div>

                            <div class="row card-body table-data">

                            </div>

                            {{-- Modal edit --}}
                            <div class="modal fade" id="editNhansuModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
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
                                            <input type="hidden" name="u_avatar" id="u_avatar">
                                            <input type="hidden" name="accountF" id="accountF" class="accountF">

                                            <div class="input-group mt-3 mb-3">
                                                <label class="input-group-text" for="">Tên hiển thị:</label>
                                                <input class="form-control" type="text" name="name" id="name">
                                            </div>

                                            <div class="input-group mt-3 mb-3">
                                                <label class="input-group-text" for="">Tài khoản:</label>
                                                <input class="form-control" name="account" id="account" placeholder="(*)">
                                                <span class="sErrAccount error">Tài khoản đã tồn tại</span>
                                            </div>

                                            {{-- <div class="input-group mt-3 mb-3"> --}}
                                                {{-- <label class="input-group-text" for="">Mật khẩu:</label> --}}
                                                {{-- <input class="form-control" type="hidden" name="password" id="password"> --}}
                                            {{-- </div> --}}


                                            <div class="input-group mt-3 mb-3">
                                                <label class="input-group-text" for="">Ảnh đại diện:</label>
                                                <input class="form-control" type="file" name="avatar">
                                            </div>

                                            <div class="input-group mt-3 mb-3">
                                                <label class="input-group-text" for="">Email:</label>
                                                <input class="form-control" type="email" name="email" id="email" placeholder="(*)">
                                                <span class="sErrEmail error">Email đã tồn tại</span>
                                            </div>


                                            <div class="mt-2" id="avatar"></div>

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

                                    <form id="formDeletenhansu" class="formDeletenhansu" action="" method="POST">
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
            $('.sErrAccount').hide();
            $('.sErrEmail').hide();
            $('#formEditNhansu').validate({
                rules:{
                    account:{
                        required: true
                    },
                    email:{
                        required: true,
                        email: true
                    }
                },
                messages:{
                    account: {
                        required: "Trường tài khoản không được để trống"
                    },
                    email: {
                        required: "Trường email không được để trống",
                        email: "Vui lòng nhập đúng định dạng email"
                    },
                },
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

            $(document).on('keyup', '#account', function(){
                $.ajax({
                    url: '{{ route("check_account_edit") }}',
                    type: 'get',
                    data: {
                            account: function(){
                                return $('#account').val();
                            },
                            '_token': $('meta[name="csrf-token"]').attr('content'),
                            accountF: function(){
                                return $('#accountF').val();
                            }
                        },
                    success: function(response){
                        if(response.status == false){
                            $('.sErrAccount').show();
                        }else{
                            $('.sErrAccount').hide();
                        }
                    }
                })
            });

            $(function() {
                fetchAllnhansus();
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
                        var nhansuRole = response.role;
                        $('#divAnhdaidien').html(`<img src="/uploads/avatars/${response.Anhdaidien}" style="width: 100px;">`);
                        $('#id').val(response.id);
                        $('#name').val(response.name);
                        $('#email').val(response.email);
                        $('#account').val(response.account);
                        $('#avatar').html(`<img src="/uploads/avatars/${response.avatar}" style="width: 100px; border-radius: 50%;">`);
                        $('#u_avatar').val(response.avatar);
                        $('#role').val(response.role);

                        $('#accountF').val(response.account);
                        $('#emailF').val(response.email);
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
                        $('#spanBacluong').text(response.Bacluong);
                        $('#spanEmail').text(response.email);

                        var formattedCreate = moment(response.created_at).format('DD/MM/YYYY HH:mm:ss');
                        $('#spanCreateAt').text(formattedCreate);
                        var formattedUpdate = moment(response.updated_at).format('DD/MM/YYYY HH:mm:ss');
                        $('#spanUpdateAt').text(formattedUpdate);
                    }
                })
            });

            $(document).on('click', '#aDeletenhansu', function(e){
                let id = $(this).data('id_xoa');

                $.ajax({
                    url: '{{ route("nhansus.edit", ":id") }}'.replace(':id', id),
                    type: 'get',
                    data:{
                        id: id,
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response){
                        var nhansuName = response.name;
                        $('#id').val(response.id);
                        $('#tb').text("Bạn chắc chắn muốn xóa người dùng: "+nhansuName+"?");
                    }
                })
            });

            $(document).on('submit', '#formEditNhansu', function(e){
                e.preventDefault();
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
                        toastr.success('Cập nhật tài khoản thành công', 'Thông báo');
                        fetchAllnhansus();
                        $('#formEditNhansu')[0].reset();
                        $('.fade').hide();
                        fetchAllnhansus();
                    },
                    error: function(){
                        toastr.error('Có lỗi xảy ra', 'Thông báo');
                    }
                })
            });

            $(document).on('submit', '#formDeletenhansu', function(e){
                e.preventDefault();
                let id = $('#id').val();
                $.ajax({
                    url: '{{ route("nhansus.destroy", ":id") }}'.replace(':id', id),
                    type: 'delete',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response){
                        toastr.success('Xóa tài khoản thành công', 'Thông báo');
                        $('#formDeletenhansu')[0].reset();
                        fetchAllnhansus();
                        $('.fade').hide();
                    }
                })
            });

                function fetchAllnhansus(){
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
                                        targets: [6]
                                    },
                                    {
                                        data: 'Ảnh đại diện',
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


