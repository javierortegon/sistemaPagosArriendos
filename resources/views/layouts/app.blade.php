<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    

    <link rel="shortcut icon" href="{{{ asset('img/favicon.ico') }}}">

    <style type="text/css">
        body {
            padding-top:110px;
        }
        #logo{
            height: 70px;
        }
        #menu{
            height: 90px;
        }
    </style>

    @yield('styles')

</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-fixed-top">
            <div class="container">
                <div id = "menu" class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse" aria-expanded="false">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand col-md-3 col-xs-4" href="{{ url('/home') }}">
                        <img id = "logo" style="" class="" src="{{{ asset('img/logo.png') }}}" alt="logo">
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @guest
                            <li><a href="{{ route('login') }}">Ingreso</a></li>
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
                                    Proyecto
                                </a>
                                <ul class="dropdown-menu">
                                    @can('proyecto.registro')
                                    <li><a href="{{ route('proyecto.registro') }}">Registrar</a></li>
                                    @endcan

                                    @can('proyectos.consultar')
                                    <li><a href="{{ route('proyectos.consultar') }}">Consultar</a></li>
                                    @endcan
                                </ul>
                            </li>

                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
                                    Propiedad
                                </a>
                                <ul class="dropdown-menu">

                                    @can('registroPropiedad')
                                    <li><a href="{{ route('registroPropiedad') }}">Registrar</a></li>
                                    @endcan

                                    @can('verPropiedades')
                                    <li><a href="{{ route('verPropiedades') }}">Consultar propiedades</a></li>
                                    @endcan

                                    @can('propiedades.cargar')
                                    <li><a href="{{ route('propiedades.cargar') }}">Carga CSV</a></li>
                                    @endcan

                                    @can('verPropiedades')
                                    <li><a href="{{ route('verVentas') }}">Consultar ventas</a></li>
                                    @endcan
                                </ul>
                            </li>

                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
                                    Usuario
                                </a>
                                <ul class="dropdown-menu">
                                    
                                    @can('usuarios.register')
                                    <li><a href="{{ route('register') }}">Registrar</a></li>
                                    @endcan

                                    @can('verUsuarios')
                                    <li><a href="{{ route('verUsuarios') }}">Consultar</a></li>
                                    @endcan

                                    @can('usuarios.cargar')
                                    <li><a href="{{ route('importUsers') }}">Carga CSV</a></li>
                                    @endcan

                                </ul>
                            </li>

                            <li class="dropdown">
                                

                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
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
    <script src="{{ asset('js/app.js') }}"></script>

    <script>
        var restaMax = 40;
        var origHeight = 90;
        $(window).scroll(function() {
            posicionScroll = $(window).scrollTop();
            if (posicionScroll <= restaMax){
                $('#logo').css('height',origHeight -20 - posicionScroll);
                $('#menu').css('height',origHeight - posicionScroll);
            }
            if (posicionScroll > restaMax){
                $('#logo').css('height',origHeight -20 - restaMax);
                $('#menu').css('height',origHeight - restaMax);
            }
        });
        $(document).ready(function(){
            posicionScroll = $(window).scrollTop();
            if (posicionScroll <= restaMax){
                $('#logo').css('height',origHeight -20 - posicionScroll);
                $('#menu').css('height',origHeight - posicionScroll);
            }
            if (posicionScroll > restaMax){
                $('#logo').css('height',origHeight -20 - restaMax);
                $('#menu').css('height',origHeight - restaMax);
            }
        });
    </script>
    
    @yield('scripts')
</body>
</html>
