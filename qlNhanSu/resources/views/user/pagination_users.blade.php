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

<div class="d-flex justify-content-center mt-3">
    {!! $users->links() !!}
</div>

<script>
    $(document).ready(function(){
                $('#userTable').DataTable({
                    dom: 'Bt',
                    buttons: [
                        'copyHtml5',
                        'excelHtml5',
                        'csvHtml5',
                        'pdfHtml5'
                    ]
                })
            })
</script>
