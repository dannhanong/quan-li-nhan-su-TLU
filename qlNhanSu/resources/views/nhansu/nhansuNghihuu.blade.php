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
                                        <h3>Danh sách nhân sự đã nghỉ hưu</h3>
                                    </div>

                                    <div class="col-md-6">
                                        <a href="{{ route('nhansus.index') }}" class="btn btn-secondary float-end">Quay lại</a>
                                    </div>
                                </div>
                            </div>

                            <div class="row card-body table-data">

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

                                    <form id="formDeleteNhansuNghiHuu" class="formDeleteNhansuNghiHuu" action="" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <input type="hidden" name="idHuu" id="idHuu">
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

                                        <div class="mb-3"><span class="spanBold">Thời gian nghỉ: </span><span id="spanDeleteAt"></span></div>
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
            $(function() {
                fetchAllNhansuNghihuus();
                toastr.options = {
                "closeButton": true,
                "progressBar": true,
                "positionClass": "toast-bottom-right",
            };

            $(document).on('click', '#aShowNhansuNghiHuu', function(){
                let id = $(this).data('id_show');
                $.ajax({
                    url: '{{ route("showNhansusnghihuu", ":id") }}'.replace(':id', id),
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

                        var formattedDelete = moment(response.delete_at).format('DD/MM/YYYY');
                        $('#spanDeleteAt').text(formattedDelete);
                    }
                })
            });

            $(document).on('click', '#aDeleteNhansuNghiHuu', function(e){
                let id = $(this).data('id_xoa');
                $.ajax({
                    url: '{{ route("showNhansusnghihuu", ":id") }}'.replace(':id', id),
                    type: 'get',
                    data:{
                        id: id,
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response){
                        var tenNhansu = response.Hoten;
                        $('#idHuu').val(response.id);
                        $('#tb').text("Bạn chắc chắn muốn xóa nhân sự: "+tenNhansu+" khỏi danh sách nghỉ hưu?");
                    }
                })
            });

            $(document).on('submit', '#formDeleteNhansuNghiHuu', function(e){
                e.preventDefault();
                let id = $('#idHuu').val();
                $.ajax({
                    url: '{{ route("nhansus.destroy", ":id") }}'.replace(':id', id),
                    type: 'delete',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response){
                        toastr.success('Xóa nhân sự thành công', 'Thông báo');
                        $('#formDeleteNhansuNghiHuu')[0].reset();
                        fetchAllNhansuNghihuus();
                        $('.fade').hide();
                    }
                })
            });

                function fetchAllNhansuNghihuus(){
                    $.ajax({
                        url: "{{ route('nhansuNghihuus.fetch') }}",
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
                                        targets: [2]
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
