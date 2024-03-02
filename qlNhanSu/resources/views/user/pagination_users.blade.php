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

<script>
    $(document).ready(function(){
        $('#userTable').DataTable({
            dom: 'B',
            select: true,
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

        });
    })
</script>
