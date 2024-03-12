<x-app-layout>
    @extends('header')
        @section('tit')
            Quản lý khen thưởng
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
                                    <h3>Danh sách khen thưởng</h3>
                                </div>

                                <div class="col-md-6">
                                    <a href="{{ route('khenthuongs.create') }}" class="btn btn-primary float-end">Thêm mới</a>
                                </div>
                            </div>
                        </div>

                        <div class="row card-body table-data">

                        </div>

                        {{-- Modal edit --}}
                        <div class="modal fade" id="editKhenthuongModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Chỉnh sửa khen thưởng</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                                </div>
                                <div class="modal-body">
                                    <form method="post" action="" class="mt-2 formEditKhenthuong" id="formEditKhenthuong" style="margin: 2.4rem">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="id" id="id">


                                        <div class="input-group mt-3 mb-3">
                                            <label class="input-group-text" for="">Mã nhân sự:</label>
                                            <input type="text" name="Manhansu" id="Manhansu" class="form-control typeahead" autocomplete="off" required>
                                            <span id="errorManhansu" class="error" style="display: none">Mã nhân sự không tồn tại</span>
                                        </div>

                                        <div class="input-group mt-3 mb-3">
                                            <label class="input-group-text" for="">Ngày khen thưởng:</label>
                                            <input type="date" class="form-control" name="ngayKhenThuong" id="ngayKhenThuong" placeholder="(*)" required>
                                        </div>

                                        <div class="">
                                            <label class="input-group-text" for="">Lý do:</label>
                                            <textarea class="form-control" name="lyDo" id="lyDo" placeholder="(*)" rows="2" required></textarea>
                                        </div>

                                        <div class="mt-3 mb-3">
                                            <label class="input-group-text" for="">Chi tiết khen thưởng:</label>
                                            <input class="form-control" name="chiTietKhenThuong" id="chiTietKhenThuong" placeholder="(*)" required>
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
                        <div class="modal fade" id="deleteKhenthuongModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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

                                <form id="formDeleteKhenthuong" class="formDeleteKhenthuong" action="" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-primary" id="btnSubmit">Xác nhận</button>
                                </form>
                                </div>

                            </div>
                            </div>
                        </div>

                        <!-- Modal show -->
                        <div class="modal fade" id="showKhenthuongModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                            <h4 class="modal-title spanBold" id="exampleModalLabel">Thông tin chi tiết khoa</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-3"><span class="spanBold">Mã nhân sự: </span><span id="spanManhansu"></span></div>
                                    <div class="mb-3"><span class="spanBold">Họ tên nhân sự: </span><span id="spanHoten"></span></div>
                                    <div class="mb-3"><span class="spanBold">Ngày khen thưởng: </span><span id="spanngayKhenThuong"></span></div>
                                    <div class="mb-3"><span class="spanBold">Lý do: </span><span id="spanlyDo"></span></div>
                                    <div class="mb-3"><span class="spanBold">Chi tiết khen thưởng: </span><span id="spanchiTietKhenThuong"></span></div>
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
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js" ></script>

        <script>
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

            $(document).on('click', '#formEditKhenthuong input, #formEditKhenthuong textarea, #formEditKhenthuong [type="submit"], .dropdown-item', function(){
                if (($('#Manhansu').val().length) > 0) {
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
                            $("#errorManhansu").hide();
                        } else {
                            $("#errorManhansu").show();
                        }
                    }
                })
                }
            });

            $(function() {
                fetchAllKhenthuongs();
                toastr.options = {
                "closeButton": true,
                "progressBar": true,
                "positionClass": "toast-bottom-right",
            };

            $(document).on('click', '#aEditKhenthuong', function(e) {
                // $('#errorMaKhoa').hide()
                let id = $(this).data('id_edit');
                $.ajax({
                    url: '{{ route("khenthuongs.edit", ":id") }}'.replace(':id', id),
                    type: 'get',
                    data: {
                        id: id,
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response){
                        $('#id').val(response.id);
                        $('#Manhansu').val(response.Manhansu);
                        $('#ngayKhenThuong').val(response.ngayKhenThuong);
                        $('#lyDo').val(response.lyDo);
                        $('#chiTietKhenThuong').val(response.chiTietKhenThuong);
                    }
                })
            });

            $(document).on('click', '#aShowKhenthuong', function(){
                let id = $(this).data('id_show');
                $.ajax({
                    url: '{{ route("khenthuongs.show", ":id") }}'.replace(':id', id),
                    type: 'get',
                    data: {
                        id: id,
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response){
                        $('#spanManhansu').text(response.Manhansu);
                        $('#spanHoten').text(response.Hoten);
                        var formattedngayKhenThuong = moment(response.ngayKhenThuong).format('DD/MM/YYYY');
                        $('#spanngayKhenThuong').text(formattedngayKhenThuong);
                        $('#spanlyDo').text(response.lyDo);
                        $('#spanchiTietKhenThuong').text(response.chiTietKhenThuong);
                        var formattedCreate = moment(response.created_at).format('DD/MM/YYYY HH:mm:ss');
                        $('#spanCreateAt').text(formattedCreate);
                        var formattedUpdate = moment(response.updated_at).format('DD/MM/YYYY HH:mm:ss');
                        $('#spanUpdateAt').text(formattedUpdate);
                    }
                })
            });

            $(document).on('click', '#aDeleteKhenthuong', function(e){
                let id = $(this).data('id_xoa');

                $.ajax({
                    url: '{{ route("khenthuongs.edit", ":id") }}'.replace(':id', id),
                    type: 'get',
                    data:{
                        id: id,
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response){
                        var Manhansu = response.Manhansu;
                        $('#id').val(response.id);
                        $('#tb').text("Bạn chắc chắn muốn xóa khen thưởng của: "+Manhansu+"?");
                    }
                })
            });

            $(document).on('submit', '#formEditKhenthuong', function(e){
                e.preventDefault();
                let id = $('#id').val();
                $.ajax({
                    url: '{{ route("khenthuongs.update", ":id") }}'.replace(':id', id),
                    type: 'post',
                    data: $('#formEditKhenthuong').serialize(),
                    success: function(response){
                        toastr.success('Cập nhật thông tin khen thưởng thành công', 'Thông báo');
                        fetchAllKhenthuongs();
                        $('#formEditKhenthuong')[0].reset();
                        $('.fade').hide();
                    },
                    error: function(){
                        toastr.error('Có lỗi xảy ra. Kiểm tra lại thông tin đã nhập', 'Thông báo');
                    }
                })
            });

            $(document).on('submit', '#formDeleteKhenthuong', function(e){
                e.preventDefault();
                let id = $('#id').val();
                $.ajax({
                    url: '{{ route("khenthuongs.destroy", ":id") }}'.replace(':id', id),
                    type: 'delete',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response){
                        toastr.success('Xóa khen thưởng thành công', 'Thông báo');
                        $('#formDeleteKhenthuong')[0].reset();
                        fetchAllKhenthuongs();
                        $('.fade').hide();
                    }
                })
            });

            function fetchAllKhenthuongs(){
                    $.ajax({
                        url: "{{ route('khenthuongs.fetch') }}",
                        type: 'get',
                        success: function(response){
                            $('.table-data').html(response);
                            $('#khenthuongTable').DataTable({
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
                                        targets: [6]
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
                            $('label[for="dt-length-1"]').remove();
                            $('label[for="dt-length-3"]').remove();
                            $('label[for="dt-length-5"]').remove();
                            $('label[for="dt-length-7"]').remove();
                            $('label[for="dt-length-9"]').remove();

                            $('#dt-search-1').attr('placeholder', 'Tìm kiếm');
                            $('#dt-length-1').prepend('<option value="5">5</option>');
                        }
                    })
                };
            });

        </script>
</x-app-layout>


