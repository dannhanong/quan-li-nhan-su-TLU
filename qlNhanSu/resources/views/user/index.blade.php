<x-app-layout>
    @extends('header')
        @section('tit')
            Quản lý tài khoản
        @endsection
        {{-- css tb --}}
        @push('css')
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/css/jquery.dataTables.min.css"
        integrity="sha512-1k7mWiTNoyx2XtmI96o+hdjP8nn0f3Z2N4oF/9ZZRgijyV4omsKOXEnqL1gKQNPy2MTSP9rIEWGcH/CInulptA=="
        crossorigin="anonymous"
        referrerpolicy="no-referrer"/>

        {{-- <link href="https://cdn.datatables.net/2.0.1/css/dataTables.dataTables.min.css" rel="stylesheet">
        <link href="https://cdn.datatables.net/buttons/3.0.0/css/buttons.dataTables.min.css" rel="stylesheet">
        <link href="https://cdn.datatables.net/datetime/1.5.2/css/dataTables.dateTime.min.css" rel="stylesheet">
        <link href="https://cdn.datatables.net/select/2.0.0/css/select.dataTables.min.css" rel="stylesheet"> --}}

        {{-- <link href="https://cdn.datatables.net/datetime/1.5.2/css/dataTables.dateTime.min.css" rel="stylesheet">
        <link href="https://cdn.datatables.net/select/2.0.0/css/select.dataTables.min.css" rel="stylesheet"> --}}
        @endpush

        {{-- js tb --}}
        @push('js')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/js/jquery.dataTables.min.js"
        integrity="sha512-BkpSL20WETFylMrcirBahHfSnY++H2O1W+UnEEO4yNIl+jI2+zowyoGJpbtk6bx97fBXf++WJHSSK2MV4ghPcg=="
        crossorigin="anonymous"
        referrerpolicy="no-referrer"></script>

        {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
        <script src="https://cdn.datatables.net/2.0.1/js/dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/3.0.0/js/dataTables.buttons.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/3.0.0/js/buttons.colVis.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/3.0.0/js/buttons.html5.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/3.0.0/js/buttons.print.min.js"></script>
        <script src="https://cdn.datatables.net/datetime/1.5.2/js/dataTables.dateTime.min.js"></script>
        <script src="https://cdn.datatables.net/select/2.0.0/js/dataTables.select.min.js"></script> --}}

        {{-- <script src="https://cdn.datatables.net/autofill/2.7.0/js/dataTables.autoFill.min.js"></script> --}}
        <script src="//cdn.datatables.net/buttons/2.3.6/js/dataTables.buttons.min.js"></script>
        <script src="//cdn.datatables.net/buttons/2.3.6/js/buttons.html5.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js" integrity="sha512-XMVd28F1oH/O71fzwBnV7HucLxVwtxf26XV8P4wPk26EDxuGZ91N8bsOttmnomcCD3CS5ZMRL50H0GgOHvegtg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.70/pdfmake.min.js" integrity="sha512-HLbtvcctT6uyv5bExN/qekjQvFIl46bwjEq6PBvFogNfZ0YGVE+N3w6L+hGaJsGPWnMcAQ2qK8Itt43mGzGy8Q==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.70/vfs_fonts.js" integrity="sha512-vv3EN6dNaQeEWDcxrKPFYSFba/kgm//IUnvLPMPadaUf5+ylZyx4cKxuc4HdBf0PPAlM7560DV63ZcolRJFPqA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        @endpush

        @section('main-content')
        <section class="content">
            <div class="container mt-4">

                <div class="container">
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-6">
                                    <h3>Danh sách tài khoản</h3>
                                </div>

                                <div class="col-md-6">
                                    <a href="{{ route('users.create') }}" class="btn btn-primary float-end">Thêm mới</a>
                                </div>

                                <div class="input-group">
                                    {{-- <h5 class="text-center mt-2">Lọc theo: </h5>

                                    <select class="mx-1" name="filter" id="filter">
                                        <option value="">Tất cả vai trò</option>
                                        @foreach ($roles as $role)
                                            @if($role == 0){
                                                {{ $quyen = "Admin" }}
                                            }@elseif ($role == 1){
                                                {{ $quyen = "Người dùng thường" }}
                                            }
                                            @endif
                                            <option value="{{ $role }}">
                                                {{ $quyen }}
                                            </option>
                                        @endforeach
                                    </select> --}}
                                    {{-- <div class="input-group rounded"> --}}
                                    <input type="search" name="search" id="search" class="form-control rounded" style="margin-left: 45%" placeholder="Tra cứu nhanh">
                                    {{-- <h6 class="mt-2 mx-1">Số bản ghi: <span id="total_records" class="input-group-btn"></span></h6> --}}
                                    {{-- </div> --}}
                                </div>
                            </div>
                        </div>

                        <div class="card-body table-data">
                            <table class="table table-bordered" id="userTable">
                                <thead>
                                    <tr>
                                        <th class="text-center align-middle">STT</th>
                                        <th class="text-center align-middle">Tên hiển thị</th>
                                        <th class="text-center align-middle">Tài khoản</th>
                                        <th class="text-center align-middle">Ảnh đại diện</th>
                                        <th class="text-center align-middle">Email</th>
                                        <th class="text-center align-middle">Loại tài khoản</th>
                                        <th class="text-center align-middle">Thao tác</th>
                                    </tr>
                                </thead>
                                @php
                                    $i = 1;
                                @endphp
                                <tbody class="allData">
                                    @foreach ($users as $user)
                                        <tr id="row_{{ $user->id }}">
                                            <td class="text-center align-middle">{{ $startNumber++ }}</td>
                                            <td class="text-center align-middle">{{ $user->name }}</td>
                                            <td class="text-center align-middle">{{ $user->account }}</td>
                                            <td class="text-center align-middle">
                                                <div style="display: inline-block; text-align: center;">
                                                    <img src="/uploads/avatars/{{ $user->avatar }}" style="width: 70px; height: 70px; border-radius: 50%;" alt="Img">
                                                </div>
                                            </td>
                                            <td class="text-center align-middle">{{ $user->email }}</td>
                                            @php
                                                if ($user->role == 1)
                                                    $quyen = "Người dùng thường";
                                                elseif ($user->role == 0) {
                                                    $quyen = "Admin";
                                                }
                                            @endphp
                                            <td class="text-center align-middle">{{ $quyen }}</td>
                                            <td class="text-center align-middle">
                                                <a href="{{ route('users.show', $user->id) }}"><i class="fa-solid fa-eye"></i></a>
                                                @if (auth()->check() && auth()->user()->role == 0)
                                                    <a id="aEditUser" data-id_edit="{{ $user->id }}" href="#" data-toggle="modal" data-target="#E{{ $user->id }}"><i class="fa-solid fa-pen-to-square"></i></a>
                                                    {{-- Modal edit --}}
                                                    <div class="modal fade" id="E{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Chỉnh sửa tài khoản</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                            </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form class="formEditUser" class="formUser" enctype="multipart/form-data" method="post" action="{{ route("users.update", $user->id) }}" class="m-5 mt-2 formUser">
                                                                    @csrf
                                                                    @method('PUT')

                                                                    <div class="input-group mt-3 mb-3">
                                                                        <label class="input-group-text" for="">Tên hiển thị:</label>
                                                                        <input class="form-control" type="text" name="name" id="name" value="{{ $user->name }}">
                                                                    </div>
                                                                    @error('name')
                                                                        <p class="text-danger">{{ $message }}</p>
                                                                    @enderror

                                                                    <div class="input-group mt-3 mb-3">
                                                                        <label class="input-group-text" for="">Tài khoản:</label>
                                                                        <input class="form-control" name="account" id="account" value="{{ $user->account }}">
                                                                    </div>
                                                                    @error('account')
                                                                        <p class="text-danger">{{ $message }}</p>
                                                                    @enderror

                                                                    {{-- <div class="input-group mt-3 mb-3"> --}}
                                                                        {{-- <label class="input-group-text" for="">Mật khẩu:</label> --}}
                                                                        <input class="form-control" type="hidden" name="password" id="password" value="{{ $user->password }}">
                                                                    {{-- </div> --}}

                                                                    <div class="input-group mt-3 mb-3">
                                                                        <label class="input-group-text" for="">Email:</label>
                                                                        <input class="form-control" type="email" name="email" id="email" value="{{ $user->email }}">
                                                                    </div>
                                                                    @error('email')
                                                                        <p class="text-danger">{{ $message }}</p>
                                                                    @enderror

                                                                    <div class="input-group mt-3 mb-3">
                                                                        <label class="input-group-text" for="">Quyền:</label>
                                                                        <select name="role" id="role">
                                                                            @foreach ($roles as $role)
                                                                                @if($role == 0){
                                                                                    {{ $quyen = "Admin" }}
                                                                                }@elseif ($role == 1){
                                                                                    {{ $quyen = "Người dùng thường" }}
                                                                                }
                                                                                @endif
                                                                                <option value="{{ $role }}">
                                                                                    {{ $quyen }}
                                                                                </option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>

                                                                    <div class="form-group float-end">
                                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                                                                        <input type="submit" name="btSave" value="Xác nhận" class="btn btn-primary">
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                        </div>
                                                    </div>

                                                    <a id="aUser" data-id_xoa="{{ $user->id }}" href="#" data-toggle="modal" data-target="#A{{ $user->id }}"><i class="aUser fa-solid fa-solid fa-trash"></i></a>
                                                    <!-- Modal delete -->
                                                    <div class="modal fade" id="A{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Xác nhận xóa</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                            </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                Bạn chắc chắn muốn xóa người dùng: {{ $user->name }} ?
                                                            </div>
                                                            <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>

                                                            <form id="modalUser" class="modalUser" action="{{ route('users.destroy', $user->id) }}" method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-primary" id="btnSubmit">Xác nhận</button>
                                                            </form>
                                                            </div>

                                                        </div>
                                                        </div>
                                                    </div>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <div class="d-flex justify-content-center mt-3">
                                {!! $users->links() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        @endsection
        <script>
            var table = $(document).ready(function(){
                $('#userTable').DataTable({
                    dom: 'B',
                    // columnDefs: [
                    //     {
                    //         data: 'Thao tác',
                    //         className: 'not-exp',
                    //         targets: [6]
                    //     }
                    // ],

                    // buttons: [
                    //     {
                    //         extend: 'copyHtml5',
                    //         text: 'Copy',
                    //         exportOptions: {
                    //             columns: ':visible :not(.not-exp)'
                    //         }
                    //     },
                    //     {
                    //         extend: 'excelHtml5',
                    //         text: 'Excel',
                    //         exportOptions: {
                    //             columns: ':visible :not(.not-exp)'
                    //         }
                    //     },
                    //     {
                    //         extend: 'csvHtml5',
                    //         text: 'CSV',
                    //         exportOptions: {
                    //             columns: ':visible :not(.not-exp)'
                    //         }
                    //     },
                    //     {
                    //         extend: 'pdfHtml5',
                    //         text: 'PDF',
                    //         exportOptions: {
                    //             columns: ':visible :not(.not-exp)'
                    //         }
                    //     },
                    //     {
                    //         extend: 'colvis',
                    //         text: 'Các trường hiển thị'
                    //     },
                    // ],
                });
            })

            $(document).on('click', '.pagination a', function(e){
                e.preventDefault();
                let page = $(this).attr('href').split('page=')[1]
                user(page);
            })

            function user(page){
                $.ajax({
                    url:"/pagination/paginate-user?page="+page,
                    success:function(res){
                        $('.table-data').html(res);
                    }
                })
            }

            $(document).on('keyup', '#search', function(e){
                e.preventDefault();
                var search = $('#search').val();
                $.ajax({
                    url: "{{ route('users.search') }}",
                    type: 'get',
                    data: {search:search},
                    success: function(response){
                        $('.table').html(response);
                    }
                });
            });

            // $(document).on('click', '#aEditUser', function(e) {
            //     e.preventDefault();
            //     var id = $(this).data('id_edit');
            //     $('#E' + id + ' .formEditUser').submit(function(e) {
            //         e.preventDefault();
            //         $.ajax({
            //             url: '{{ route("users.update", ":id") }}'.replace(':id', id),
            //             type: 'put',
            //             data: $(this).serialize(),
            //             success: function(response) {
            //                 // $('.fade').hide();
            //                 // $('.table').load(location.href+' .table');
            //                 window.open("/users", "_self");
            //                 toastr.options = {
            //                     "closeButton": true,
            //                     "progressBar": true,
            //                     "positionClass": "toast-bottom-right",
            //                 };
            //                 toastr.success('Chỉnh sửa tài khoản thành công', 'Thông báo');
            //             }
            //         });
            //     });
            // });

            // $(document).on('click', '#aUser', function(e){
            //     $id = $(this).data('id_xoa');
            //     $('.modalUser').submit(function(e){
            //         e.preventDefault();
            //         $.ajax({
            //             url: '/users/' + $id,
            //             type: 'delete',
            //             headers: {
            //                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            //             },
            //             success: function(response){
            //                 $('.table').load(location.href+' .table');
            //                 $('#row_'+$id).remove();
            //                 $('.fade').hide();

            //                 toastr.options = {
            //                     "closeButton": true,
            //                     "progressBar": true,
            //                     "positionClass": "toast-bottom-right",
            //                 }
            //                 toastr.success('Xóa tài khoản thành công', 'Thông báo');

            //                 propertycatstable.ajax.reload();
            //             },
            //         })
            //     })
            // })

        </script>
</x-app-layout>


