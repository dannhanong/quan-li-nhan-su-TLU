<x-app-layout>
@extends('header')
    @section('main-content')
    <section class="content">

        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <div class="small-box icon">
                        <a href="{{ route('dashboard') }}">
                            <div class="box-content">
                                <i class="fa-solid fa-house ic "></i>
                                <h4 class="can">Trang chủ</h4>
                            </div>
                        </a>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="small-box icon">
                        <a href="{{ route('khoas.index') }}">
                            <div class="box-content">
                                <i class="fa-solid fa-building ic"></i>
                                <h4 class="can">Khoa</h4>
                            </div>
                        </a>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="small-box icon">
                        <a href="{{ route('users.index') }}">
                            <div class="box-content">
                                <i class="fa-solid fa-user-group ic"></i>
                                <h4 class="can">Tài khoản</h4>
                            </div>
                        </a>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="small-box icon">
                        <a href="{{ route('khoas.index') }}">
                            <div class="box-content">
                                <i class="fa-solid fa-building ic"></i>
                                <h4 class="can">Khoa</h4>
                            </div>
                        </a>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-3">
                    <div class="small-box icon">
                        <a href="{{ route('khoas.index') }}">
                            <div class="box-content">
                                <i class="fa-solid fa-people-group ic"></i>
                                <h4 class="can">Nhân sự</h4>
                            </div>
                        </a>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="small-box icon">
                        <a href="{{ route('profile.edit') }}">
                            <div class="box-content">
                                <i class="fa-solid fa-exclamation ic"></i>
                                <h4 class="can">Thông tin tài khoản</h4>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>

    </section>
    @endsection
</x-app-layout>
