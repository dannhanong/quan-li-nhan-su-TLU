<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Trang quản lý nhân sự TLU</title>
    <link rel="stylesheet" href="{{ asset('assets') }}/css/bootstrap.min.css">
    <link href="bootoast.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="{{ asset('assets') }}/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('assets') }}/css/Admin.css">
    <link rel="stylesheet" href="{{ asset('assets') }}/css/_all-skins.min.css">
    <link rel="stylesheet" href="{{ asset('assets') }}/css/dashboard.css">
    <link rel="stylesheet" href="{{ asset('assets') }}/css/style.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">
    <script src="{{ asset('assets') }}/js/jquery.min.js"></script>

    @stack('css')
    @stack('js')
</head>
<body>


