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
                                    <input type="text" name="search" id="search" class="form-control" placeholder="Nhập từ khóa bạn muốn tra cứu">
                                    {{-- <h6 class="mt-2 mx-1">Số bản ghi: <span id="total_records" class="input-group-btn"></span></h6> --}}
                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                            <table class="table table-bordered">
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
                                    @foreach ($users as $user)
                                        <tr>
                                            <td class="text-center align-middle">{{ $user->id }}</td>
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
                                                    <a href="#" data-toggle="modal" data-target="#A{{ $user->id }}"><i class="fa-solid fa-solid fa-trash"></i></a>

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
                                                                Bạn chắc chắn muốn xóa user có ID: {{ $user->id }} ?
                                                            </div>
                                                            <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>

                                                            <form action="{{ route('users.destroy', $user->id) }}" method="POST">
                                                                @csrf
                                                                @method('DELETE')

                                                                <button type="submit" class="btn btn-primary">Xác nhận</button>
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
                        </div>

                        <div class="d-flex justify-content-center">
                            {!! $users->links() !!}
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

            // Lấy thẻ thông báo
            var toast = document.getElementById("successToast");

            // Thiết lập thời gian đếm ngược (milliseconds)
            var hideTimer = 5000; // 5 giây

            // Thiết lập hàm để ẩn thẻ thông báo
            function hideToast() {
                toast.style.display = "none";
            }

            // Thiết lập hẹn giờ để tự động ẩn thẻ thông báo
            setTimeout(hideToast, hideTimer);

        </script>

</x-app-layout>


