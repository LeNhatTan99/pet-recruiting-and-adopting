<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Css -->
    <link rel="stylesheet" href="{{ asset('base/css/jquery-ui.css') }}">
    <link rel="stylesheet" href="{{ asset('base/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('base/css/sweetalert2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('base/css/toastr.min.css') }}">

    <link rel="stylesheet" href="{{ asset('auth/css/form.css') }}">
</head>
<body>
    @yield('content')
    <script src="{{ asset('base/js/jquery-2.2.4.js') }}"></script>
    <script src="{{ asset('base/js/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('base/js/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('base/js/toastr.min.js') }}"></script>
    @yield('js')
    @if (session('success') || session('error'))
        <script type="text/javascript">
            toastr.options = {
            "closeButton": true,
            "debug": false,
            "newestOnTop": false,
            "progressBar": true,
            "positionClass": "toast-bottom-right",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "3000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
            };
            @if (session('success'))
                Command: toastr["success"]("{{ session('success') }}")
            @elseif(session('error'))
                Command: toastr["error"]("{{ session('error') }}")
            @elseif(session('warning'))
                Command: toastr["warning"]("{{ session('warning') }}")
            @elseif(session('info'))
                Command: toastr["info"]("{{ session('info') }}")
            @else
            @endif
        </script>
    @endif
</body>
</html>
