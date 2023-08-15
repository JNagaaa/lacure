<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    

    <!-- Scripts -->
    @vite('resources/tinymce/tinymce.min.js')
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    @php
        $fetchNotificationsRoute = route('notifications.fetch');
    @endphp

    <style>
        .header {
            background-image: url('{{ asset('src/img/banner.png') }}');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            text-align: center;
            padding: 200px 0; /* Ajustez ce padding en fonction de vos besoins */
            color: white;
        }

        .header h2 {
            font-size: 48px;
            font-weight: bold;
        }
    
        .navbar {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
        }
    
        .navbar-brand {
            color: white;
            font-size: 24px;
            font-weight: bold;
        }
    
        .navbar-nav .nav-link {
            color: white;
        }
    </style>
    
</head>


<body>
    <div id="app">
        <div class="header">
            <nav class="navbar navbar-expand-md navbar-light bg-transparent">
                <div class="container-fluid">
                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{ __('La Cure') }}
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
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
                                        <a class="nav-link" href="{{ route('login') }}">{{ __('Connexion') }}</a>
                                    </li>
                                @endif

                                @if (Route::has('register'))
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('register') }}">{{ __('Inscription') }}</a>
                                    </li>
                                @endif
                            @else

                                @if(Auth::user()->admin == 1)
                                    <li class="nav-item dropdown">
                                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                            {{ __('Interface administrateur') }}
                                        </a>

                                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                            <a class="dropdown-item" href="{{ url('/admin/sports/home') }}">
                                                {{ __('Sports') }}
                                            </a>

                                            <a class="dropdown-item" href="{{ url('/admin/horeca/home') }}">
                                                {{ __('Horeca') }}
                                            </a>

                                            <a class="dropdown-item" href="{{ url('/admin/users/list') }}">
                                                {{ __('Utilisateurs') }}
                                            </a>
                                        </div>
                                    </li>
                                @endif

                                
                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        {{ __('Sports') }}
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="{{ url('/sports/home') }}">
                                            {{ __('Accueil') }}
                                        </a>

                                        <a class="dropdown-item" href="{{ url('/sports/planning?date=' . \Illuminate\Support\Carbon::today()->format('Y-m-d')) }}">
                                            {{ __('Planning') }}
                                        </a>

                                    </div>
                                </li>

                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        {{ __('Horeca') }}
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="{{ url('/horeca/home') }}">
                                            {{ __('Accueil') }}
                                        </a>

                                        <a class="dropdown-item" href="{{ url('/horeca/planning?date=' . \Illuminate\Support\Carbon::today()->format('Y-m-d')) }}">
                                            {{ __('Réserver') }}
                                        </a>
                                        
                                        <a class="dropdown-item" href="{{ url('/horeca/menu') }}">
                                            {{ __('Menu') }}
                                        </a>
                                        
                                    </div>
                                </li>

                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        {{ Auth::user()->name }}
                                    </a>
                                    
                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="{{ url('/users/one/'.Auth::user()->id) }}">
                                            {{ __('Mon profil') }}
                                        </a>

                                        <a class="dropdown-item" href="{{ url('/profile/reservations/'.Auth::user()->id) }}">
                                            {{ __('Mes réservations') }}
                                        </a>

                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                        document.getElementById('logout-form').submit();">
                                            {{ __('Déconnexion') }}
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                            @csrf
                                        </form>
                                    </div>
                                </li>

                                <li class="nav-item dropdown">
                                    <a id="notifications-dropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="bi bi-bell"></i>
                                        <span id="numberNotif" class="badge bg-danger"></span>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="notifications-dropdown">
                                        <div id="notifications-list" class="notifications-list"></div>
                                    </div>
                                </li>
                            @endguest
                        </ul>
                    </div>
                </div>
            </nav>
            <h2>La Cure</h2>
            <h3>Tennis club, bar et petite restauration</h3>
        </div>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
