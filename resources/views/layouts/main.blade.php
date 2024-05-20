<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <link href="/landing_page/css/bootstrap.min.css" rel="stylesheet">
    <link href="/landing_page/css/main.css" rel="stylesheet">
</head>

<body>
    @include('layouts.header')

    {{-- main content --}}
    <main>
        <div>
            @yield('content')

        </div>
    </main>

    @include('layouts.footer')
</body>
<script src="/landing_page/js/bootstrap.bundle.min.js"></script>
<script src="/landing_page/js/main.js"></script>

</html>
