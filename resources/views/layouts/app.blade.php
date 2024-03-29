<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link rel='stylesheet' href='/mon_style.css'>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    @if (Auth::user() && (Auth::user()->user_verified == 1))
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">
                      <li class="nav-item">
                        <a class="nav-link" href="/membres">Les Membres</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="/membre/4">Un Membre</a>
                      </li>
                      @guest
                      @else
                      <li class="nav-item">
                        <a class="nav-link" href="/creer">Créer un Membre</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="/modifier/1">Modifier un Membre</a>
                      </li>
                      @endguest
                    </ul>
                    @endif               

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
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
                            <li class="nav-item">
                              <a class="nav-link">Connecté : {{ Auth::user()->name }}</a>
                            </li>
                            @if(Auth::user() && (Auth::user()->role == 'admin'))
                            <li class="nav-item">
                              <a class="nav-link" href="/admin">Administration</a>
                            </li>
                            @endif
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                              @csrf
                            </form>
                            <li class="nav-item">
                              <a class="nav-link" href="{{ route('logout') }}"
                                  onclick="event.preventDefault();
                                  document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                              </a>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4 container">
            @yield('content')
        </main>
    </div>
</body>
</html>
