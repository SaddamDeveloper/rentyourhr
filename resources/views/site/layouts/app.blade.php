<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required Meta Tags -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <!-- Page Title -->
    <title>Rent Your HR | @yield('title')</title>
    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('site/assets/images/logo/favicon.png') }}" type="image/x-icon">
    <!-- CSS Files -->
    <link rel="stylesheet" href="{{ asset('site/assets/css/animate-3.7.0.css') }}">
    <link rel="stylesheet" href="{{ asset('site/assets/css/font-awesome-4.7.0.min.css') }}">
    <link rel="stylesheet" href="{{ asset('site/assets/fonts/flat-icon/flaticon.css') }}">
    <link rel="stylesheet" href="{{ asset('site/assets/css/bootstrap-4.1.3.min.css') }}">
    <link rel="stylesheet" href="{{ asset('site/select2/dist/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('site/select2/dist/css/select2-bootstrap.min.css') }}">
    <link href="{{ asset('backend/plugin/jquery-confirm/css/jquery-confirm.min.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{ asset('site/assets/css/owl-carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('site/assets/css/nice-select.css') }}">
    <link rel="stylesheet" href="{{ asset('site/assets/css/style.css') }}">
    <link href="{{ asset('site/loader/jquery.loadingModal.min.css') }}" rel="stylesheet">
    <link href="{{ asset('site/toastr/toastr.min.css') }}" rel="stylesheet">
    @yield('mystyle')
</head>
<body>
    <div class="preloader">
        <div class="spinner"></div>
    </div>

    @include('site.layouts.header')

    @yield('content')

    @include('site.layouts.footer')

    <!-- Javascript -->
    <script src="{{ asset('site/assets/js/vendor/jquery-2.2.4.min.js') }}"></script>
    <script src="{{ asset('site/assets/js/vendor/bootstrap-4.1.3.min.js') }}"></script>
    <script src="{{ asset('site/select2/dist/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('site/assets/js/vendor/wow.min.js') }}"></script>
    <script src="{{ asset('site/assets/js/vendor/owl-carousel.min.js') }}"></script>
    <script src="{{ asset('site/assets/js/vendor/jquery.nice-select.min.js') }}"></script>
    <script src="{{ asset('site/assets/js/vendor/ion.rangeSlider.js') }}"></script>
    <script src="{{ asset('site/assets/js/main.js') }}"></script>
    <script src="{{ asset('backend/plugin/jquery-confirm/js/jquery-confirm.min.js') }}"></script>
    <script src="{{ asset('site/loader/jquery.loadingModal.min.js') }}"></script>
    <script src="{{ asset('site/toastr/toastr.min.js') }}"></script>
    @include('site.scripts.common')
    @yield('myscript')
</body>
</html>
