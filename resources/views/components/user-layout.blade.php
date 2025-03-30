<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title }}</title>
    <meta content="width=device-width, initial-scale=1.0, shrink-to-fit=no" name="viewport" />

    <link href="{{ asset('css/sweetalert2.min.css') }}" rel="stylesheet">
    <link rel="icon" href="{{ asset('template/image/diversiti.svg') }}" type="image/x-icon" />

    <!-- Fonts and icons -->
    <script src="{{ asset('template/assets/js/plugin/webfont/webfont.min.js') }}"></script>

    <!-- CSS Files -->
    <link rel="stylesheet" href="{{ asset('template/assets/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('template/assets/css/plugins.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('template/assets/css/kaiadmin.min.css') }}" />
    <link href="{{ asset('css/summernote-lite.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('template/costum.css') }}" />
</head>

<body>

    <!-- Sidebar & Navbar -->
    <!-- End Sidebar & Navbar -->
    <div class="wrapper sidebar_minimize">
        <x-user-loading></x-user-loading>
        <x-User-Navbar></x-User-Navbar>
        <div class="main-panel">
            <x-User-Profile-Nav>
                <x-slot:title>{{ $title }}</x-slot:title>
            </x-User-Profile-Nav>

            {{ $slot }}

        </div>
    </div>

    <!--   Core JS Files   -->
    <script src="{{ asset('template/assets/js/core/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('template/assets/js/core/popper.min.js') }}"></script>
    <script src="{{ asset('template/assets/js/core/bootstrap.min.js') }}"></script>

    <!-- jQuery Scrollbar -->
    <script src="{{ asset('template/assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js') }}"></script>

    <!-- Chart JS -->
    <script src="{{ asset('template/assets/js/plugin/chart.js/chart.min.js') }}"></script>

    <!-- jQuery Sparkline -->
    <script src="{{ asset('template/assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js') }}"></script>

    <!-- Chart Circle -->
    <script src="{{ asset('template/assets/js/plugin/chart-circle/circles.min.js') }}"></script>

    <!-- Datatables -->
    <script src="{{ asset('template/assets/js/plugin/datatables/datatables.min.js') }}"></script>

    <!-- jQuery Vector Maps -->
    <script src="{{ asset('template/assets/js/plugin/jsvectormap/jsvectormap.min.js') }}"></script>
    <script src="{{ asset('template/assets/js/plugin/jsvectormap/world.js') }}"></script>

    <!-- Sweet Alert -->
    <script src="{{ asset('js/sweetalert2.all.min.js') }}"></script>

    <!-- Kaiadmin JS -->
    <script src="{{ asset('template/assets/js/kaiadmin.min.js') }}"></script>

    <!-- Kaiadmin DEMO methods, don't include it in your project! -->
    <script src="{{ asset('template/assets/js/setting-demo.js') }}"></script>
    <script src="{{ asset('template/assets/js/demo.js') }}"></script>
    <script src="{{ asset('js/summernote-lite.min.js') }}"></script>
    <script src="{{ asset('template/costum.js') }}"></script>

</body>

</html>
