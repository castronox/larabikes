<!DOCTYPE html>
<html lang="en">
@env(['local', 'test'])
<div class="alert alert-warning">
    <b>Atención !!! </b>estás probando la App en modo local o test.
    <!-- Nothing worth having comes easy. - Theodore Roosevelt -->
</div>
@endenv

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name') }} - @yield('titulo')</title>

    <!-- Carga del CSS de Bootstrap 4 -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" defer></script>
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Estilos adicionales -->
    <style>
        body {
            background-color: #f8f9fa;
        }

        .jumbotron {
            background-color: rgba(6, 62, 69, 0.32);
            color: #fff;
            padding: 2rem;
            border-radius: 0;
        }

        .jumbotron h1,
        .jumbotron p {
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
        }

        .navbar {
            background-color: #343a40;
        }

        .navbar .nav-link {
            color: #fff;
        }

        .footer {
            background-color: #343a40;
            color: #fff;
        }
    </style>
</head>

<body class="container p-3">

    @if (Auth::user() && !Auth::user()->hasVerifiedEmail())
    <div class="alert alert-warning">
        <strong>¡Advertencia!</strong> Su email no está verificado. Por favor, verifique su email.
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <button type="submit" class="btn btn-link p-0 m-0 align-baseline">Reenviar email de verificación</button>.
        </form>
    </div>
@endif


    <!-- PARTE SUPERIOR -->
    @section('navegacion')
        @php($pagina = Route::currentRouteName())
        <nav class="navbar navbar-expand-md navbar-dark bg-dark mb-3">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">LaraBikes</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link {{ $pagina == 'portada' ? 'active' : '' }} "
                                href="{{ route('portada') }}">Inicio</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ $pagina == 'bikes.index' || $pagina == 'bikes.search' ? 'active' : '' }} "
                                href="{{ route('bikes.index') }}">Garaje</a>
                        </li>
                        @auth                     
                        <li class="nav-item">
                            <a class="nav-link {{ $pagina == 'bikes.create' ? 'active' : '' }}  "
                                href="{{ route('bikes.create') }}">Nueva Moto</a>
                        </li>
                        <li class="nav-item" >
                            <a class="nav-link {{$pagina=='home' ? 'active':''}}" href="{{route('home')}}">Mis motos</a>
                        </li>
                        @endauth
                        <li class="nav-item mr-2">
                            <a class="nav-link {{ $pagina == 'contacto' ? 'active' : '' }}"
                                href="{{ route('contacto') }}">Contacto</a>
                        </li>
                        <!-- Authentication Links -->
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
                                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                        </li>
                                    @endif

                                    @if (Route::has('register'))
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ route('register') }}">{{ __('Registro') }}</a>
                                        </li>
                                    @endif
                                @else
                                    <li class="nav-item dropdown">
                                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                            {{ Auth::user()->name }} | ({{ Auth::user()->email}})
                                        </a>

                                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                            <a class="dropdown-item" href="{{ route('home') }}">
                                                {{ __('Mi perfil') }}
                                            </a>
                                            
                                            <a class="dropdown-item" href="{{ route('logout') }}"
                                                onclick="event.preventDefault();
                                                            document.getElementById('logout-form').submit();">
                                                {{ __('Cierra sesión') }}
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
                    </ul>
                </div>
            </div>
        </nav>
    @show
    <!-- PARTE CENTRAL -->
    <h1 class="my-2">{{ config('app.name') }}</h1>

    <main>
        <h2>@yield('titulo')</h2>

        @if (Session::has('success'))
            <div class="alert alert-success">
                {{ Session::get('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <p>Se han producido errores:</p>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>
                            {{ $error }}
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif
        @yield('contenido')

        <div class="btn-group" role="group" aria-label="Links">
            @section('enlaces')
                <a href="{{ url()->previous() }}" class="btn btn-primary m-2">Atras</a>
                <a href="{{ route('portada') }}" class="btn btn-primary m-2">Inicio</a>
            @show
        </div>
    </main>

    <!-- PARTE INFERIOR -->
    @section('pie')
        <footer class="footer mt-auto py-3">
            <div class="container text-center">
                <p class="text-muted">Aplicación creada por {{ $autor }} como ejemplo de clase desarrollada y
                    haciendo
                    uso de Bootstrap y Laravel.</p>
            </div>
        </footer>
    @show

    <!-- Scripts de Bootstrap (jQuery primero, luego Popper.js, luego Bootstrap JS) -->
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/popper.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
</body>

</html>
