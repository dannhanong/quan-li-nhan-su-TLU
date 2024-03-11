<x-app-layout>
@extends('header')
    @section('main-content')
    <section class="content">

        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <div class="small-box icon">
                        <a href="{{ route('dashboard') }}">
                            <div class="box-content text-center">
                                <i class="fa-solid fa-house my-4 ic"></i>
                                <h4 class="can">Trang chủ</h4>
                            </div>
                        </a>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="small-box icon">
                        <a href="{{ route('khoas.index') }}">
                            <div class="box-content text-center">
                                <i class="fa-solid fa-building my-4 ic"></i>
                                <h4 class="can">Khoa</h4>
                            </div>
                        </a>
                    </div>
                </div>

                @if (auth()->check() && auth()->user()->role == 0)
                    <div class="col-md-3">
                        <div class="small-box icon">
                            <a href="{{ route('users.index') }}">
                                <div class="box-content text-center">
                                    <i class="fa-solid fa-user-group my-4 ic"></i>
                                    <h4 class="can">Trung tâm tài khoản</h4>
                                </div>
                            </a>
                        </div>
                    </div>
                @endif

                <div class="col-md-3">
                    <div class="small-box icon">
                        <a href="{{ route('nhansus.index') }}">
                            <div class="box-content text-center">
                                <i class="fa-solid fa-people-group my-4 ic"></i>
                                <h4 class="can">Nhân sự</h4>
                            </div>
                        </a>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="small-box icon">
                        <a href="{{ route('chucvus.index') }}">
                            <div class="box-content text-center">
                                <i class="fa-solid fa-rectangle-list my-4 ic"></i>
                                <h4 class="can">Chức vụ</h4>
                            </div>
                        </a>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="small-box icon">
                        <a href="{{ route('hopdongs.index') }}">
                            <div class="box-content text-center">
                                <i class="fa-solid fa-file-signature my-4 ic"></i>
                                <h4 class="can">Hợp đồng</h4>
                            </div>
                        </a>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="small-box icon">
                        <a href="{{ route('profile.edit') }}">
                            <div class="box-content text-center">
                                <i class="fa-solid fa-circle-exclamation my-4 ic"></i>
                                <h4 class="can">Thông tin</h4>
                            </div>
                        </a>
                    </div>
                </div>

            </div>
        </div>

    </section>
    @endsection
</x-app-layout>
