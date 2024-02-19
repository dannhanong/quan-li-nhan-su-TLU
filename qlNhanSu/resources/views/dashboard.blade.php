<x-app-layout>
@extends('header')
<link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    @section('main-content')
    <section class="content">
    {{-- <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot> --}}

    {{-- <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div> --}}
    {{-- @include('manager') --}}
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
