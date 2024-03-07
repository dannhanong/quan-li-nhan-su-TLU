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
                                    <h3>Danh sách khoa</h3>
                                </div>

                                <div class="col-md-6">
                                    <a href="{{ route('chucvus.create') }}" class="btn btn-primary float-end">Thêm mới</a>
                                </div>
                            </div>
                        </div>

                        <div class="row card-body table-data">

                        </div>

                        {{-- Modal edit --}}
                        <div class="modal fade" id="editChucvuModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Chỉnh sửa chức vụ</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                                </div>
                                <div class="modal-body">
                                    <form method="post" action="" class="m-5 mt-2 formEditChucvu" id="formEditChucvu">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="id" id="id">
                                        <input type="hidden" name="maChucVuF" id="maChucVuF">

                                        <div class="input-group mt-3 mb-3">
                                            <label class="input-group-text" for="">Mã chức vụ:</label>
                                            <input class="form-control" type="text" name="maChucVu" id="maChucVu" placeholder="(*)">
                                            <span id="errorMaChucVu" class="error">Mã chức vụ đã tồn tại</span>
                                        </div>

                                        <div class="input-group mt-3 mb-3">
                                            <label class="input-group-text" for="">Tên chức vụ:</label>
                                            <input class="form-control" name="tenChucVu" id="tenChucVu" placeholder="(*)">
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
                        <div class="modal fade" id="deleteChucvuModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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

                                <form id="formDeleteChucvu" class="formDeleteChucvu" action="" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-primary" id="btnSubmit">Xác nhận</button>
                                </form>
                                </div>

                            </div>
                            </div>
                        </div>

                        <!-- Modal show -->
                        <div class="modal fade" id="showChucvuModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                            <h4 class="modal-title spanBold" id="exampleModalLabel">Thông tin chi tiết chức vụ</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-3 display"><h4 class="spanBold mt-5 mx-3" id="h4TenChucvu"></h4></div>
                                    <div class="mb-3"><span class="spanBold">Mã chức vụ: </span><span id="spanMaChucvu"></span></div>
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
            $('#errorMaChucVu').hide();
            $('#formEditChucvu').validate({
                rules:{
                    maChucVu:{
                        required: true
                    },
                    tenChucVu:{
                        required: true
                    }
                },
                messages:{
                    maChucVu: {
                        required: "Vui lòng nhập mã chức vụ"
                    },
                    tenChucVu: {
                        required: "Vui lòng nhập tên chức vụ"
                    },
                },
            });

            $(document).on('keyup', '#maChucVu', function(){
                $.ajax({
                    url: '{{ route("check_maChucVu_unique") }}',
                    type: 'get',
                    data: {
                        maChucVuF: function(){
                            return $('#maChucVuF').val();
                        },
                        '_token': $('meta[name="csrf-token"]').attr('content'),
                        maChucVu: function(){
                            return $('#maChucVu').val();
                        }
                    },
                    success: function(response){
                        if(response == 'false'){
                            $('#errorMaChucVu').show();
                        }else{
                            $('#errorMaChucVu').hide();
                        }
                    }
                })
            });

            $(function() {
                fetchAllChucvus();
                toastr.options = {
                "closeButton": true,
                "progressBar": true,
                "positionClass": "toast-bottom-right",
            };

            $(document).on('click', '#aEditChucvu', function(e) {
                let id = $(this).data('id_edit');
                $.ajax({
                    url: '{{ route("chucvus.edit", ":id") }}'.replace(':id', id),
                    type: 'get',
                    data: {
                        id: id,
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response){
                        $('#id').val(response.id);
                        $('#maChucVu').val(response.maChucVu);
                        $('#tenChucVu').val(response.tenChucVu);
                        $('#maChucVuF').val(response.maChucVu);
                    }
                })
            });

            $(document).on('click', '#aShowChucvu', function(){
                let id = $(this).data('id_show');
                $.ajax({
                    url: '{{ route("chucvus.show", ":id") }}'.replace(':id', id),
                    type: 'get',
                    data: {
                        id: id,
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response){
                        $('#h4TenChucvu').text(response.tenChucVu);
                        $('#spanMaChucvu').text(response.maChucVu);
                        var formattedCreate = moment(response.created_at).format('DD/MM/YYYY HH:mm:ss');
                        $('#spanCreateAt').text(formattedCreate);
                        var formattedUpdate = moment(response.updated_at).format('DD/MM/YYYY HH:mm:ss');
                        $('#spanUpdateAt').text(formattedUpdate);
                    }
                })
            });

            $(document).on('click', '#aDeleteChucvu', function(e){
                let id = $(this).data('id_xoa');
                $.ajax({
                    url: '{{ route("chucvus.edit", ":id") }}'.replace(':id', id),
                    type: 'get',
                    data:{
                        id: id,
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response){
                        var tenChucVu = response.tenChucVu;
                        $('#id').val(response.id);
                        $('#tb').text("Bạn chắc chắn muốn xóa chức vụ: "+tenChucVu+"?");
                    }
                })
            });

            $(document).on('submit', '#formEditChucvu', function(e){
                e.preventDefault();
                let id = $('#id').val();
                $.ajax({
                    url: '{{ route("chucvus.update", ":id") }}'.replace(':id', id),
                    type: 'post',
                    data: $('#formEditChucvu').serialize(),
                    success: function(response){
                        toastr.success('Cập nhật thông tin chức vụ thành công', 'Thông báo');
                        fetchAllChucvus();
                        $('#formEditChucvu')[0].reset();
                        $('.fade').hide();
                    },
                    error: function(){
                        toastr.error('Có lỗi xảy ra', 'Thông báo');
                    }
                })
            });

            $(document).on('submit', '#formDeleteChucvu', function(e){
                e.preventDefault();
                let id = $('#id').val();
                $.ajax({
                    url: '{{ route("chucvus.destroy", ":id") }}'.replace(':id', id),
                    type: 'delete',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response){
                        toastr.success('Xóa chức vụ thành công', 'Thông báo');
                        $('#formDeleteChucvu')[0].reset();
                        fetchAllChucvus();
                        $('.fade').hide();
                    }
                })
            });

            function fetchAllChucvus(){
                    $.ajax({
                        url: "{{ route('chucvus.fetch') }}",
                        type: 'get',
                        success: function(response){
                            $('.table-data').html(response);
                            $('#chucvuTable').DataTable({
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
                                select: true,
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


