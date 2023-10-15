<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title> @yield('title') </title>
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- Theme style -->
        <link rel="stylesheet" href="{{ asset ('pages/admin/admin.min.css' ) }}">
        <link rel="stylesheet" href="{{ asset('base/css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('base/css/fontawesome/css/all.min.css') }}">
        <link rel="stylesheet" href="{{ asset('base/css/sweetalert2.min.css') }}">
        <link rel="stylesheet" href="{{ asset('base/css/toastr.min.css') }}">
        <link rel="stylesheet" href="{{ asset('base/css/owl.carousel.min.css') }}">
        <!-- CSS -->
        <link rel="stylesheet" href="{{ asset ('pages/admin/style.css' ) }}">

    </head>
    <body class="hold-transition sidebar-mini layout-fixed">
        <div class="wrapper">
            @include('admin.layouts.header')
            @yield('content')
            @include('admin.layouts.sidebar')
            @include('admin.layouts.footer')
        </div>
        
        <script src="{{ asset('base/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('base/js/jquery-2.2.4.js') }}"></script>
        <script src="{{ asset('base/js/owl.carousel.min.js') }}"></script>
        <script src="{{ asset('base/js/sweetalert2.min.js') }}"></script>
        <script src="{{ asset('base/js/toastr.min.js') }}"></script>
        <script src="{{ asset('base/js/jquery.validate.min.js') }}"></script>
    </body>
</html>