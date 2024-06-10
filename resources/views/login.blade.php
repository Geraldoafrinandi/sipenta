<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link href="{{ asset('landing_page/css/login.css') }}" rel="stylesheet">
    <link href="{{ asset('landing_page/css/loading.css') }}" rel="stylesheet">
</head>

<body>
    <section class="container">
        <div class="login-container">
            <div class="circle circle-one"></div>
            <div class="form-container">
                <form id="login-form" method="POST" action="{{ route('login') }}">
                    @csrf
                    <h1 class="opacity">LOGIN</h1>

                    <!-- Notifikasi sukses registrasi -->
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <!-- Display Errors -->
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div>
                        <input id="email" class="block mt-1 w-full" type="email" name="email" required autofocus autocomplete="email" placeholder="Email" value="{{ old('email') }}">
                    </div>
                    <div>
                        <input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" placeholder="Password">
                    </div>
                    <div>
                        <button type="submit">
                            <span>{{ __('Login') }}</span>
                        </button>
                    </div>
                    <p style="opacity: 50%">Belum Punya Akun? </p>
                    <a style="opacity: 50%; text-decoration: underline;" href="/register"><u>Register</u></a>
                </form>
            </div>
            <div class="circle circle-two"></div>
        </div>
        <div class="theme-btn-container"></div>
    </section>
</body>

</html>
