<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>SIPENTA </title>

    <!-- CSS -->
    <link href="{{ asset('dashboard/css/main.css') }}" rel="stylesheet">
    <link href="{{ asset('dashboard/css/style.min.css') }}" rel="stylesheet">
    <link href="{{ asset('dashboard/css/themify-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('dashboard/css/vendor.bundle.base.css') }}" rel="stylesheet">

</head>
<div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    <div class="page-wrapper">
        <div class="left-sidebar">
            @include('admin.layouts.sidebar')
        </div>
        <div class="body-wrapper">
            <header class="app-header">
                <nav class="navbar navbar-expand-lg navbar-light">
                    @include('admin.layouts.header')
                </nav>
            </header>
        </div>
        <div class="body-wrapper">
            <div class="content-wrapper">
                <div class="container-fluid">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>
    <!-- end page-wrapper -->
</div>
</body>

<!-- JS Plugins (place them at the bottom of <body>) -->
<script src="{{ asset('dashboard/libss/jquery/dist/jquery.min.js') }}"></script>
<script src="{{ asset('dashboard/libss/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('dashboard/js/app.min.js') }}"></script>
<script src="{{ asset('dashboard/js/dashboard.js') }}"></script>
<script src="{{ asset('dashboard/js/sidebarmenu.js') }}"></script>
<script src="{{ asset('dashboard/libss/apexcharts/dist/apexcharts.min.js') }}"></script>
<script src="{{ asset('dashboard/libss/simplebar/dist/simplebar.js') }}"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

</html>
