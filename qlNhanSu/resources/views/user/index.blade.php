<x-app-layout>
    @extends('header')
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
                                    <h5 class="text-center mt-2">Lọc theo: </h5>

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
                                    </select>

                                    <input type="text" name="search" id="search" class="form-control" style="margin-left: 45%" placeholder="Tra cứu nhanh">
                                    {{-- <h6 class="mt-2 mx-1">Số bản ghi: <span id="total_records" class="input-group-btn"></span></h6> --}}
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

                                <tbody class="allData">
                                    {{-- @php
                                        $i = 1;
                                    @endphp --}}
                                    @foreach ($users as $user)
                                        <tr id="row_{{ $user->id }}">
                                            <td class="text-center align-middle">{{ $startNumber++ }}</td>
                                            <td class="text-center align-middle">{{ $user->name }}</td>
                                            <td class="text-center align-middle">{{ $user->account }}</td>
                                            <td class="text-center align-middle">
                                                <img src="/uploads/avatars/{{ $user->avatar }}" style="width: 70px; height: 70px; margin-left: 20%; border-radius: 50%" alt="Img">
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
                                                    <a href="{{ route('users.edit', $user->id) }}"><i class="fa-solid fa-pen-to-square"></i></a>
                                                    <a id="aUser" data-id_xoa="{{ $user->id }}" href="#" data-toggle="modal" data-target="#A{{ $user->id }}"><i class="aUser fa-solid fa-solid fa-trash"></i></a>

                                                    <!-- Modal -->
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

                                <tbody id="Content" class="searchData"></tbody>
                            </table>

                            <div class="d-flex justify-content-center">
                                {!! $users->links() !!}
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </section>
        @endsection

        <script>
            var isSendingData = false; // Biến kiểm tra trạng thái gửi dữ liệu

            $('#search').on('keyup', function(){
                $value = $(this).val();

                if($value != ''){ // Kiểm tra nếu có dữ liệu được nhập vào
                    $('.allData').hide();
                    $('.searchData').show();

                    // Kiểm tra nếu không đang gửi dữ liệu
                    if (!isSendingData) {
                        // Đặt biến trạng thái gửi dữ liệu thành true
                        isSendingData = true;

                        $.ajax({
                            type: 'get',
                            url: '{{ URL::to('search') }}',
                            data: { 'search': $value },
                            success: function(data){
                                $('#Content').html(data);
                                // Đặt biến trạng thái gửi dữ liệu thành false sau khi nhận dữ liệu thành công
                                isSendingData = false;
                            },
                            error: function(xhr, status, error) {
                                // Đặt biến trạng thái gửi dữ liệu thành false nếu có lỗi trong quá trình gửi dữ liệu
                                isSendingData = false;
                            }
                        });
                    }
                } else {
                    // Nếu không có dữ liệu được nhập vào, không gửi yêu cầu AJAX
                    $('.allData').show();
                    $('.searchData').hide();
                }
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

            $('#filter').on('change', function(e){
                var $role = e.target.value;
                if ($role != '') {
                    $('.allData').hide();
                    $('.searchData').show();

                    if (!isSendingData) {
                        isSendingData = true;
                        $.ajax({
                            type: 'get',
                            url: '{{ URL::to('filter') }}',
                            data: { 'filter': $role },
                            success: function(data){
                                $('#Content').html(data);
                                isSendingData = false;
                            },
                            error: function(xhr, status, error) {
                                isSendingData = false;
                            }
                        });
                    }
                } else {
                    $('.allData').show();
                    $('.searchData').hide();
                }
            });

            $(document).on('click', '#aUser', function(e){
                $id = $(this).data('id_xoa');
                $('.modalUser').submit(function(e){
                    e.preventDefault();
                    $.ajax({
                        url: '/users/' + $id,
                        type: 'DELETE',
                        dataType: 'json',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response){
                            $('#row_'+$id).remove();
                            $('.fade').hide();
                            toastr.options = {
                                "closeButton": true,
                                "progressBar": true,
                                "positionClass": "toast-bottom-right",
                            }
                            toastr.success('Xóa tài khoản thành công');
                        },
                    })
                })
            })

        </script>

</x-app-layout>


