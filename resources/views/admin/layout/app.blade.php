<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Rent Your HR | @yield('title')</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="stylesheet" href="{{ asset('backend/plugin/bootstrap/dist/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/plugin/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/plugin/Ionicons/css/ionicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/plugin/iCheck/all.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/plugin/select2/dist/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/css/style.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/css/skins/_all-skins.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/css/custom.css') }}">
    <link href="{{ asset('backend/plugin/jquery-confirm/css/jquery-confirm.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('backend/plugin/loader/jquery.loadingModal.min.css') }}" rel="stylesheet">
    <link href="{{ asset('backend/plugin/toastr/toastr.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('backend/plugin/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <!-- Google Font -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <link href="https://vjs.zencdn.net/7.5.5/video-js.css" rel="stylesheet" />
    <!-- If you'd like to support IE8 (for Video.js versions prior to v7) -->
    <script src="https://vjs.zencdn.net/ie8/1.1.2/videojs-ie8.min.js"></script>
    @yield('mystyle')
</head>
<body class="hold-transition skin-blue fixed sidebar-mini">
    <div class="wrapper">
        @include('admin.layout.topbar')
        <aside class="main-sidebar">
            @include('admin.layout.sidebar')
        </aside>
        <div class="content-wrapper">
            @yield('content')
        </div>
        @include('admin.layout.footer')
    </div>

    <script src="{{ asset('backend/plugin/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('backend/plugin/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('backend/plugin/select2/dist/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('backend/plugin/bootstrap-filestyle/src/bootstrap-filestyle.min.js') }}"></script>
    <script src="{{ asset('backend/plugin/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
    <script src="{{ asset('backend/plugin/fastclick/lib/fastclick.js') }}"></script>
    <script src="{{ asset('backend/js/custom.min.js') }}"></script>
    <script src="{{ asset('backend/js/demo.js') }}"></script>
    <script src="{{ asset('backend/plugin/jquery-confirm/js/jquery-confirm.min.js') }}"></script>
    <script src="{{ asset('backend/plugin/iCheck/icheck.min.js') }}"></script>
    <script src="{{ asset('backend/plugin/loader/jquery.loadingModal.min.js') }}"></script>
    <script src="{{ asset('backend/plugin/toastr/toastr.min.js') }}"></script>
    <script src="{{ asset('backend/plugin/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="https://vjs.zencdn.net/7.5.5/video.js"></script>
    @include('admin.scripts.common')
    @yield('myscript')
</body>

</html>
