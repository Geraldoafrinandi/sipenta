<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard</title>

    <link href="/dashboard/css/main2.css" rel="stylesheet">


</head>

<body>
    <div>
        @include('admin.layouts.sidebar')
    </div>

    <main id="content-wrapper" class="d-flex flex-column">
        @yield('content')

    </main>

<div>
    @include('admin.layouts.footer')
</div>

</body>
<script src="/dashboard/js/main.js"></script>

</html>
