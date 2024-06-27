<!DOCTYPE html>
<html lang="en">
@env(['local' , 'test'])
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

    <!-- Carga del CSS de Bootstrap -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">

    <!-- Estilos adicionales -->
    <style>
        body {
            background-color: #f8f9fa;
        }

        .jumbotron {
            background-color: #063e4552;
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

    <!-- PARTE SUPERIOR -->
    @section('navegacion')
    @php($pagina = $pagina ?? '')
        <nav class="navbar navbar-expand-lg navbar-dark mb-3">
            <div class="container">
                <a class="navbar-brand" href="#">LaraBikes</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link {{$pagina=='portada' ? 'active' : ''}} " 
                            href="{{ url('/') }}">Inicio</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{$pagina=='listamotos' ? 'active' : ''}} " 
                            href="{{ route('bikes.index') }}">Garaje</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{$pagina=='nuevamoto' ? 'active' : ''}}  " 
                            href="{{ route('bikes.create') }}">Nueva Moto</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    @show
    <!-- PARTE CENTRAL -->
    <h1 class="my-2">{{config('app.name')}}</h1>

    <main>
        <h2>@yield('titulo')</h2>

        @if (Session::has('success'))
        <x-alert type="success" message="{{ Session::get('success')}}"/>
        @endif

        @if($errors->any())
        
        <x-alert type="danger" message="Se han producido errores:" >
            <ul>
                @foreach ($errors->all() as $error )
                    <li>
                        {{$error}}
                    </li>
                @endforeach
            </ul>
        </x-alert>
        
        @endif
        @yield('contenido')

        <div class="btn-group" role="group" aria-label="Links">
            @section('enlaces')
                <a href="{{ url('/') }}" class="btn btn-primary m-2">Inicio</a>
            @show
        </div>





    </main>

    <!-- PARTE INFERIOR -->
    @section('pie')
        <footer class="footer mt-auto py-3">
            <div class="container text-center">
                <p class="text-muted">Aplicación creada por {{$autor}} como ejemplo de clase desarrollada y haciendo
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
