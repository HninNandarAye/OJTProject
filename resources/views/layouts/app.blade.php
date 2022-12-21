<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- System Logo -->
    <link rel="icon" href="../images/image1.webp">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@lang("public.title")</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/jquery-ui.css')}}">
    <!-- data table -->
    <link rel="stylesheet" href="{{asset('css/jquery.dataTables.min.css')}}">   

    <!-- select2 -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
</head>

<body class="body-bg">
    <div id="app">
        <nav class="navbar navbar-expand-md nav-bg shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    @lang("public.title")
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    @auth
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item ">
                            <a class="nav-link {{ Request::is('students/add') ? 'active':'';}}" href="{{ url('students/add') }}">@lang("public.add")</a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link {{ Request::is('students/delete') ? 'active':'';}}" href="{{ url('students/delete') }}">@lang("public.remove")</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ Request::is('students/update') ? 'active':'';}}" href="{{ url('students/update') }}">@lang("public.update")</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ Request::is('students/view') ? 'active':'';}}" href="{{ url('students/view') }}">@lang("public.view")</a>
                        </li>
                    </ul>
                    @endauth
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                @lang("public.language")
                            </a>

                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{  url('locale/en') }}">
                                    @lang("public.en")
                                </a>
                                <a class="dropdown-item" href="{{  url('locale/jp') }}">
                                    @lang("public.jp")
                                </a>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    @lang("public.logout")
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>

                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
   
    
</body>

</html>