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
