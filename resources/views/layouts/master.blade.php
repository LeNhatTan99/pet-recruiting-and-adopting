<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title> @yield('title') </title>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('base/css/font-roboto.css') }}">

        {{-- <link rel="stylesheet" href="{{ asset('base/css/jquery-ui.css') }}"> --}}
        <link rel="stylesheet" href="{{ asset('base/css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('base/css/fontawesome/css/all.min.css') }}">
        <link rel="stylesheet" href="{{ asset('base/css/sweetalert2.min.css') }}">
        <link rel="stylesheet" href="{{ asset('base/css/toastr.min.css') }}">
        <link rel="stylesheet" href="{{ asset('base/css/owl.carousel.min.css') }}">

        <link rel="stylesheet" href="{{ asset('layouts/css/header.css') }}">
        <link rel="stylesheet" href="{{ asset('pages/css/style.css') }}">

        @yield('css')
    </head>
    <body class="antialiased">
        @include('layouts.header')
		<div class="content-wrapper">
			@yield('content')
		</div>
		@include('layouts.footer')

        <script src="{{ asset('base/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('base/js/jquery-2.2.4.js') }}"></script>
        <script src="{{ asset('base/js/owl.carousel.min.js') }}"></script>
        <script src="{{ asset('base/js/sweetalert2.min.js') }}"></script>
        <script src="{{ asset('base/js/toastr.min.js') }}"></script>
        <script src="{{ asset('base/js/jquery.validate.min.js') }}"></script>
        @yield('js')
    </body>
</html>
