<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-5 mt-5">
                <div class="card mt-5" style="background-color: #d1e189;">
                    <h2 class="text-center mt-3">{{ __('Login') }}</h2>
                    <div class="card-body mt-3">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="mb-3 ms-3 me-3">
                                <label for="email">{{ __('Email Address') }}</label>
                                <input id="email" type="text" class="form-control @error('email') is-invalid @enderror " name="email" value="{{ old('email') }}" autocomplete="email" autofocus>
                                @error('email')
                                <span class="invalid-feedback" role="alert"> 
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="ms-3 me-3">
                                <label for="password">{{ __('Password') }}</label>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="current-password">
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror

                            </div>
                            <div class="mt-4 d-flex justify-content-center">
                                <button type="submit" class="btn" id="form-btn">
                                    {{ __('Login') }}
                                </button>
                            </div>

                            <div class="mb-3 mt-3 d-flex justify-content-center">
                                @if (Route::has('password.request'))
                                <a class="btn btn-link" href="{{ route('password.request') }}" style="color:#7a7c13;">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                                @endif
                            </div>
                    </div>


                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
</body>

</html>