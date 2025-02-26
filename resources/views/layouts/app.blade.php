<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') . ' | ' . config('app.version') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/jquery/jquery.js') }}"></script>
    <script src="{{ asset('js/jquery/jquery-ui.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('font-awesome-4.7.0/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('js/jquery/jquery-ui.css') }}" rel="stylesheet">


    <!-- Plugin DataTable -->
    <script src="{{ asset('js/datatable/jquery.dataTables.min.js') }}"></script>
    <link href="{{ asset('js/datatable/jquery.dataTables.min.css') }}" rel="stylesheet">


</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-lg navbar-light" style="background-color: rgba(10,23,55,0.5);">
            <div class="container">
                <a class="navbar-brand text-sm text-warning underline" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link text-sm text-warning" href="{{ route('login') }}"><i
                                            class="fa fa-sign-in fa-lg" aria-hidden="true"></i>{{ __('Login') }}</a>
                                </li>
                            @endif

                            {{-- @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link text-sm text-warning" href="{{ route('register') }}"><i
                                            class="fa fa-registered fa-lg"
                                            aria-hidden="true"></i>{{ __('Registrar') }}</a>
                                </li>
                            @endif --}}
                        @else
                            <li class="nav-item dropdown">

                                <a id="navbarDropdownTeam" class="nav-link  dropdown-toggle text-sm text-warning"
                                    role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                    href="#"><i class="fa fa-globe fa-lg"
                                        aria-hidden="true"></i>{{ __('Temporada') }}</a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownTeam">
                                    <a class="dropdown-item" href="{{ route('create_season') }}"><i class="fa fa-plus"
                                            aria-hidden="true"></i>
                                        {{ __('Adicionar') }}
                                    </a>
                                    <a class="dropdown-item" href="{{ route('view_season') }}"><i class="fa fa-list-ol"
                                            aria-hidden="true"></i>
                                        {{ __('Visualizar') }}
                                    </a>

                                </div>

                            </li>

                            <li class="nav-item dropdown">

                                <a id="navbarDropdownTeam" class="nav-link  dropdown-toggle text-sm text-warning"
                                    role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                    href="#"><i class="fa fa-users fa-lg"
                                        aria-hidden="true"></i>{{ __('Time') }}</a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownTeam">
                                    <a class="dropdown-item" href="{{ route('create_team') }}"><i class="fa fa-plus"
                                            aria-hidden="true"></i>
                                        {{ __('Adicionar') }}
                                    </a>
                                    <a class="dropdown-item" href="{{ route('view_team') }}"><i class="fa fa-list-ol"
                                            aria-hidden="true"></i>
                                        {{ __('Visualizar') }}
                                    </a>

                                </div>

                            </li>



                            <li class="nav-item dropdown">
                                <a id="navbarDropdownSeason" class="nav-link  dropdown-toggle text-sm text-warning"
                                    role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                    href="#"><i class="fa fa-futbol-o fa-lg"
                                        aria-hidden="true"></i>{{ __('Partidas') }}</a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownSeason">
                                    <a class="dropdown-item" href="{{ route('create_matches') }}"><i class="fa fa-users"
                                            aria-hidden="true"></i>
                                        {{ __('Informar Resultado') }}
                                    </a>
                                    <a class="dropdown-item" href="{{ route('dashboard_matches') }}"><i
                                            class="fa fa-list-ol" aria-hidden="true"></i>
                                        {{ __('Dashboard') }}
                                    </a>

                            </li>

                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle text-warning" href="#"
                                    role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                    v-pre>
                                    <i class="fa fa-user-circle-o fa-lg" aria-hidden="true"></i>{{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        <i class="fa fa-sign-out fa-lg" aria-hidden="true"></i>{{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                        class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        <main class="py-4">
            @yield('content')
        </main>
    </div>

    <script src="{{ asset('js/core.js') }}" defer></script>

</body>

</html>
