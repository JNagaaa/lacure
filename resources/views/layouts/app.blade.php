<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" style="background-color: #333333;">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    

    <!-- Scripts -->
    @vite('resources/tinymce/tinymce.min.js')
    @vite(['resources/sass/app.scss', 'resources/css/app.css', 'resources/js/app.js'])

    @php
        $fetchNotificationsRoute = route('notifications.fetch');
    @endphp
    
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ __('La Cure') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>                

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
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
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="margin-top:15px;" v-pre>
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
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="margin-top:15px;" v-pre>
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
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="margin-top:15px;" v-pre>
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
                        <a id="notifications-dropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="margin-top:13px;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-bell" viewBox="0 0 16 16">
                                <path d="M8 16a2 2 0 0 0 2-2H6a2 2 0 0 0 2 2zM8 1.918l-.797.161A4.002 4.002 0 0 0 4 6c0 .628-.134 2.197-.459 3.742-.16.767-.376 1.566-.663 2.258h10.244c-.287-.692-.502-1.49-.663-2.258C12.134 8.197 12 6.628 12 6a4.002 4.002 0 0 0-3.203-3.92L8 1.917zM14.22 12c.223.447.481.801.78 1H1c.299-.199.557-.553.78-1C2.68 10.2 3 6.88 3 6c0-2.42 1.72-4.44 4.005-4.901a1 1 0 1 1 1.99 0A5.002 5.002 0 0 1 13 6c0 .88.32 4.2 1.22 6z"/>
                            </svg>
                            <span id="numberNotif" class="badge bg-danger" style="position: relative; top: -6px;"></span>
                        </a>
                        
                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="notifications-dropdown">
                            <div id="notifications-list" class="notifications-list"></div>
                        </div>
                    </li> 

                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }}
                            @if(Auth::user()->image != NULL)
                            <img style="width:50px; height:50px; border-radius:50%; margin-left:5px;" src="{{url('storage/'.Auth::user()->image)}}">
                            @else
                                <img style="width:50px; height:50px; border-radius:50%; margin-left:5px;" src="{{url('images/default.png')}}">
                            @endif
                        </a>
                        
                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ url('/users/one/'.Auth::user()->id) }}">
                                {{ __('Mon profil') }}
                            </a>

                            <a class="dropdown-item" href="{{ url('/users/reservations/'.Auth::user()->id) }}">
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

                                           
                    @endguest
                    </ul>
                </div>
            </div>
        </nav>
        
        <div class="header">
            <h2>La Cure</h2>
            <h3>Tennis club, bar et petite restauration</h3>
        </div>

        <main class="py-4" style="background-color:rgba(202, 120, 21, 0.951);">
            @yield('content')
        </main>
    </div>
    <footer class="text-center p-4" style="background-color: #333333; color: white;">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <h4>Contact Horeca:</h4>
                    <p>Email : lacure.administration@gmail.com</p>
                    <p>Téléphone : 123-456-7890</p>
                </div>
                <div class="col-md-4">
                    <h4>Conditions d'utilisations</h4>
                </div>
                <div class="col-md-4">
                    <h4>Contact sports:</h4>
                    <p>Email : lacure.administration@gmail.com</p>
                    <p>Téléphone : 123-456-7890</p>
                </div>
            </div>
            <hr class="my-4">
            <p>&copy; 1989 Belgian Association for Tennis Development</p>
        </div>
    </footer>
</body>
</html>
