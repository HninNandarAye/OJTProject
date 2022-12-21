<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@lang("public.title")</title>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body class="body-bg">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-5 ">
                <div class="card mt-3" style="background-color: #afda97;">
                    <h2 class="text-center mt-3">@lang("public.register")</h2>
                    <div class="card-body mt-3">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf
                            <div class="mb-3 ms-3 me-3">
                                <label for="name">@lang("public.name")</label>
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}"  autocomplete="name" autofocus>
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="mb-3 ms-3 me-3">
                                <label for="email">@lang("public.email")</label>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="email">
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="mb-3 ms-3 me-3">
                                <label for="password">@lang("public.password")</label>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="new-password">
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="mb-3 ms-3 me-3">
                                <label for="password-confirm" class="col-md-4 col-form-label text-md-end">@lang("public.confirm-password")</label>
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" autocomplete="new-password">
                            </div>
                            <div class="mt-4 mb-3 d-flex justify-content-center">
                                <button type="submit" class="btn" id="form-btn">
                                    @lang("public.register")
                                </button>
                            </div>                            
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>