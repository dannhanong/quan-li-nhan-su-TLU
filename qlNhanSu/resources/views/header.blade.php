<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('tit')</title>
    <link rel="stylesheet" href="{{ asset('assets') }}/css/bootstrap.min.css">
    <link href="bootoast.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="{{ asset('assets') }}/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('assets') }}/css/Admin.css">
    <link rel="stylesheet" href="{{ asset('assets') }}/css/_all-skins.min.css">
    <link rel="stylesheet" href="{{ asset('assets') }}/css/dashboard.css">
    <link rel="stylesheet" href="{{ asset('assets') }}/css/style.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">
    <link rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/css/jquery.dataTables.min.css"
      integrity="sha512-1k7mWiTNoyx2XtmI96o+hdjP8nn0f3Z2N4oF/9ZZRgijyV4omsKOXEnqL1gKQNPy2MTSP9rIEWGcH/CInulptA=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <script src="{{ asset('assets') }}/js/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/js/jquery.dataTables.min.js"
      integrity="sha512-BkpSL20WETFylMrcirBahHfSnY++H2O1W+UnEEO4yNIl+jI2+zowyoGJpbtk6bx97fBXf++WJHSSK2MV4ghPcg=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"></script>
    {{-- <script src="https://cdn.datatables.net/autofill/2.7.0/js/dataTables.autoFill.min.js"></script> --}}
    <script src="//cdn.datatables.net/buttons/2.3.6/js/dataTables.buttons.min.js"></script>
    <script src="//cdn.datatables.net/buttons/2.3.6/js/buttons.html5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js" integrity="sha512-XMVd28F1oH/O71fzwBnV7HucLxVwtxf26XV8P4wPk26EDxuGZ91N8bsOttmnomcCD3CS5ZMRL50H0GgOHvegtg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.70/pdfmake.min.js" integrity="sha512-HLbtvcctT6uyv5bExN/qekjQvFIl46bwjEq6PBvFogNfZ0YGVE+N3w6L+hGaJsGPWnMcAQ2qK8Itt43mGzGy8Q==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.70/vfs_fonts.js" integrity="sha512-vv3EN6dNaQeEWDcxrKPFYSFba/kgm//IUnvLPMPadaUf5+ylZyx4cKxuc4HdBf0PPAlM7560DV63ZcolRJFPqA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>
<body>


