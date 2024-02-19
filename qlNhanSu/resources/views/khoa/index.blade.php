<x-app-layout>
@extends('header')
    @section('main-content')
    <section class="content">
        <h1 class="text-center text-success" >Danh sách khoa</h1>

        @if (auth()->check() && auth()->user()->role == 0)
            <a class="btn btn-success mx-4 mt-2 mb-2 " href="{{ route('khoas.create') }}">Thêm khoa</a>
        @endif

        @if ($message = Session::get('success'))
            <div class="alert alert-success mx-4">
                {{ $message }}
            </div>
        @endif

        <div class="row container-fluid mt-2">
            <div class="col-sm">
                <table class="table table-bordered">
                    <thead>
                        <tr class="table-dark">
                            <th class="text-center align-middle" scope="col">Mã khoa</th>
                            <th class="text-center align-middle" scope="col">Tên khoa</th>
                            <th class="text-center align-middle" scope="col">Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($khoas as $khoa)
                            <tr>
                                <th class="text-center align-middle" scope="row">{{ $khoa->id }}</th>
                                <td class="text-center align-middle">{{ $khoa->tenKhoa }}</td>
                                <td  class="text-center align-middle">
                                    <a href="{{ route('khoas.show', $khoa->id) }}"><i class="fa-solid fa-eye"></i></a>
                                    @if (auth()->check() && auth()->user()->role == 0)
                                        <a href="{{ route('khoas.edit', $khoa->id) }}"><i class="fa-solid fa-pen-to-square"></i></a>
                                        <a href="#" data-toggle="modal" data-target="#A{{ $khoa->id }}"><i class="fa-solid fa-solid fa-trash"></i></a>

                                        <!-- Modal -->
                                        <div class="modal fade" id="A{{ $khoa->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Xác nhận xóa</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                                </button>
                                                </div>
                                                <div class="modal-body">
                                                    Bạn chắc chắn muốn xóa Khoa có ID: {{ $khoa->id }} ?
                                                </div>
                                                <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>

                                                <form action="{{ route('khoas.destroy', $khoa->id) }}" method="POST">
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
                </table>
            </div>
        </div>

        <div class="d-flex justify-content-center mt-5">
            {!! $khoas->links() !!}
        </div>

    </section>
    @endsection

</x-app-layout>
@include('footer')



