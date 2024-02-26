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
                                    <h3>Danh sách chức vụ</h3>
                                </div>

                                <div class="col-md-6">
                                    <a href="{{ route('chucvus.create') }}" class="btn btn-primary float-end">Thêm mới</a>
                                </div>

                                <div class="input-group">
                                    <input type="text" name="search" id="search" class="form-control" placeholder="Tra cứu nhanh">
                                    {{-- <h6 class="mt-2 mx-1">Số bản ghi: <span id="total_records" class="input-group-btn"></span></h6> --}}
                                </div>
                            </div>
                        </div>

                        <div class="card-body table-data">
                            <table class="table table-bordered" id="chucvuTable">
                                <thead>
                                    <tr>
                                        <th class="text-center align-middle">STT</th>
                                        <th class="text-center align-middle">Tên chức vụ</th>
                                        <th class="text-center align-middle">Thao tác</th>
                                    </tr>
                                </thead>

                                <tbody class="allData">
                                    {{-- @php
                                        $i = 1;
                                    @endphp --}}
                                    @foreach ($chucvus as $chucvu)
                                        <tr>
                                            <td class="text-center align-middle">{{ $startNumber++ }}</td>
                                            <td class="text-center align-middle">{{ $chucvu->tenChucVu }}</td>
                                            <td class="text-center align-middle">
                                                <a href="{{ route('chucvus.show', $chucvu->id) }}"><i class="fa-solid fa-eye"></i></a>
                                                @if (auth()->check() && auth()->user()->role == 0)
                                                    <a href="{{ route('chucvus.edit', $chucvu->id) }}"><i class="fa-solid fa-pen-to-square"></i></a>
                                                    <a href="#" data-toggle="modal" data-target="#A{{ $chucvu->id }}"><i class="fa-solid fa-solid fa-trash"></i></a>

                                                    <!-- Modal -->
                                                    <div class="modal fade" id="A{{ $chucvu->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Xác nhận xóa</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                            </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                Bạn chắc chắn muốn xóa chức vụ: {{ $chucvu->tenChucVu }} ?
                                                            </div>
                                                            <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>

                                                            <form action="{{ route('chucvus.destroy', $chucvu->id) }}" method="POST">
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

                            <div class="d-flex justify-content-center">
                                {!! $chucvus->links() !!}
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
                            url: '{{ URL::to('searchc') }}',
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
                chucvu(page);
            })

            function chucvu(page){
                $.ajax({
                    url:"/pagination/paginate-chucvu?page="+page,
                    success:function(res){
                        $('.table-data').html(res);
                    }
                })
            }

        </script>

</x-app-layout>


