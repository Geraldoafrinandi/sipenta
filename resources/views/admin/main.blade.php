<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <title>@yield('title', 'Dashboard Template · Bootstrap v5.3')</title>

    <!-- Bootstrap CSS -->
    <link href="{{ asset('dashboard/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="{{ asset('dashboard/css/sign-in.css') }}" rel="stylesheet">
    <link href="{{ asset('dashboard/css/back.css') }}" rel="stylesheet">

    <!-- Inline style example -->
    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }

        /* Your additional custom styles */
    </style>
</head>
<body>

    <!-- Include header from admin.layouts.header -->
    @include('admin.layouts.header')

    <div class="container-fluid">
        <div class="row">

            <!-- Include sidebar from admin.layouts.sidebar -->
            @include('admin.layouts.sidebar')

            <!-- Main content area -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                @yield('content')
            </main>
        </div>
    </div>

    <!-- Bootstrap Bundle JS (including Popper) -->
    <script src="{{ asset('dashboard/js/bootstrap.bundle.min.js') }}"></script>

</body>
</html>
