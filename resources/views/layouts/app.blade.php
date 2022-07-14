<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">

    <!-- Scripts -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudfare.com/ajax/libs/axios/0.19.2/axios.min.js"></script>
</head>
<body>
    <div id="app">
        <div class="nav-header">
            <nav class="navbar navbar-expand-md navbar-light shadow-sm">
                <div class="container px-0 px-sm-auto">
                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{ config('app.name', 'Laravel') }}
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <!-- Left Side Of Navbar -->
                        <ul class="navbar-nav me-auto">

                        </ul>

                        <!-- Right Side Of Navbar -->
                        <ul class="navbar-nav ms-auto align-items-end">
                            <!-- Authentication Links -->
                            @guest
                                @if (Route::has('login'))
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                    </li>
                                @endif

                                @if (Route::has('register'))
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                    </li>
                                @endif
                            @else
                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle d-none d-md-block" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        {{ Auth::user()->firstname }}
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                        document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                            @csrf
                                        </form>
                                    </div>
                                     <a href="{{ route('dashboard') }}" class="nav-link d-block d-md-none text-grey border-bottom border-2">
                                        Dashboard
                                    </a>
                                    <a href="{{ route('patients') }}" class="nav-link d-block d-md-none text-grey border-bottom border-2">
                                        Covid Records
                                    </a>
                                    <a href="{{ route('changepassword') }}" class="nav-link d-block d-md-none text-grey border-bottom border-2">
                                        Change Password
                                    </a>
                                    <a class="nav-link d-block d-md-none border-bottom border-2 bg-dark text-white" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form-sp').submit();">
                                        Logout as  {{ Auth::user()->firstname }}
                                    </a>
                                    <form id="logout-form-sp" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </li>
                            @endguest
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-md-2 px-sm-2 px-5 d-none d-md-block" style="background-color: #f6f6e9; font-size:18px;">
                    @include('sidebar')
                </div>
                <div class="col-12 col-md-10 p-3 p-md-4">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>
</body>
<footer>
    <script src="https://code.iconify.design/2/2.2.1/iconify.min.js"></script>

    <script src="{{ asset('js/app.js') }}" defer></script>
</footer>
</html>
