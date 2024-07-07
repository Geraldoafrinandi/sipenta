<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register</title>
    <link href="{{ asset('landing_page/css/login.css') }}" rel="stylesheet">
</head>

<body>
    <section class="container">
        <div class="login-container">
            <div class="circle circle-one"></div>
            <div class="form-container">
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <h1 class="opacity">REGISTER</h1>

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
                        <input id="name" class="block mt-1 w-full" type="text" name="name" required autofocus autocomplete="name" placeholder="Name" value="{{ old('name') }}">
                    </div>
                    <div>
                        <input id="email" class="block mt-1 w-full" type="email" name="email" required autocomplete="email" placeholder="Email" value="{{ old('email') }}">
                    </div>
                    <div>
                        <input id="nim" class="block mt-1 w-full" type="text" name="nim" autocomplete="nim" placeholder="NIM" value="{{ old('nim') }}">
                    </div>
                    <div>
                        <input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" placeholder="Password">
                    </div>
                    <div>
                        <input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="Confirm Password">
                    </div>

                    <div>
                        <button type="submit">
                            <span>{{ __('Register') }}</span>
                        </button>
                    </div>
                    <p style="opacity: 50%">Sudah punya akun? </p>
                    <a style="opacity: 50%; text-decoration: underline;" href="/login"><u>Login</u></a>
                </form>
            </div>
            <div class="circle circle-two"></div>
        </div>
        <div class="theme-btn-container"></div>
    </section>
</body>

</html>
