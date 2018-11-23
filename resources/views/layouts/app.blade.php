<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'CloudBucket') }}</title>

    <!-- Styles -->
    <link href="{{asset('img/ico.ico')}}" rel="shortcut icon" type="image/x-icon" />
<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css')}}">    
</head>
<body>
<div id="app"></div>
    <div id="app1">
        <nav class="navbar-default navbar-static-top nav">
            <div class="container">                
                <div style="width:500px;" class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse" aria-expanded="false">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <img class="logo" src="{{ asset('img/logo.png')}}" alt="">
                    <a class="navbar-brand" href="{{ url('/') }}">
                        <p class="text-white"><b>{{ config('app.name', 'CloudBucket') }}</b></p>
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">                       
                    <!-- Left Side Of Navbar -->   
                    <ul class="nav navbar-nav">                                    
                        @guest
                            &nbsp
                            @else
                            @if(Auth::user()->rol=='Freelancer')
                            <li><a href="{{route('chat')}}"><p class="text-white"><span class="glyphicon glyphicon-envelope" aria-hidden="true"> </span> Bandeja</p></a></li>
                            <li><a href="{{ route('buscarProyecto') }}"><p class="text-white"><span class="glyphicon glyphicon-search" aria-hidden="true"></span> Buscar Proyecto</p></a></li>
                            <li><a href="{{ route('home') }}"><p class="text-white"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Mis Proyectos</p></a></li>
                            @endif

                            @if(Auth::user()->rol=='Cliente')
                            <li><a href="{{route('chat')}}"><p class="text-white"><span class="glyphicon glyphicon-envelope" aria-hidden="true"> </span> Bandeja</p></a></li>
                            <li><a href="{{ route('vistaproyecto') }}"><p class="text-white"><span class="glyphicon glyphicon-briefcase" aria-hidden="true"></span> Subir Proyecto</p></a></li>
                            <li><a href="{{ route('home') }}"><p class="text-white"><span class="glyphicon glyphicon-folder-open" aria-hidden="true"></span> Mis Proyectos</p></a></li>
                            @endif

                            @if(Auth::user()->rol=='Empresa')
                            <li><a href="{{route('chat')}}"><p class="text-white"><span class="glyphicon glyphicon-envelope" aria-hidden="true"> </span> Bandeja</p></a></li>
                            <li><a href="{{ route('vistaproyecto') }}"><p class="text-white"><span class="glyphicon glyphicon-briefcase" aria-hidden="true"></span> Subir Proyecto</p></a></li>
                            <li><a href="{{ route('home') }}"><p class="text-white"><span class="glyphicon glyphicon-folder-open" aria-hidden="true"></span> Mis Proyectos</p></a></li>
                            @endif
                        @endguest
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @guest
                            <li><a href="{{ route('login') }}"><p class="text-white">Iniciar sesión</p></a></li>
                            <li><a href="{{ route('register') }}"><p class="text-white">Registrarse</p></a></li>
                        @else
                            <li class="dropdown">
                                <a style="color:white" href="#" id="AuthDropDown" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="{{ route('perfil') }}">
                                            <span class="glyphicon glyphicon-user"></span> Perfil
                                        </a>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                             <span class="glyphicon glyphicon-log-out"></span> Salir
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        @yield('content')
    </div>

    <!-- Scripts -->
    <script
    src="https://code.jquery.com/jquery-2.2.4.js"
    integrity="sha256-iT6Q9iMJYuQiMWNd9lDyBUStIq/8PuOW33aOqmvFpqI="
    crossorigin="anonymous">
    </script>
    
    </script>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/zxcvbn-bootstrap-strength-meter.js') }}"></script>
    <script src="{{ asset('js/star-rating-show.js') }}"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.9/js/all.js"
    integrity="sha384-8iPTk2s/jMVj81dnzb/iFR2sdA7u06vHJyyLlAd4snFpCl/SnyUjRrbdJsw1pGIl" 
    crossorigin="anonymous"></script>
</body>
</html>
