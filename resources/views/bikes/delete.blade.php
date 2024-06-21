<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name') }} - PORTADA</title>

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
                        <a class="nav-link active" href="{{ url('/') }}">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('bikes.index') }}">Garaje</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('bikes.create') }}">Nueva Moto</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- PARTE CENTRAL -->
    <h1 class="my-2">Gestor de motos de Larabikes</h1>

    <main>

        <h2>Borrado de la moto {{"$bike->marca $bike->modelo"}}</h2>


            <form method="POST" class="my-2 border p-5" action="{{route('bikes.destroy', $bike->id)}}">
                {{ csrf_field() }}
                <input name="_method" type="hidden" value="DELETE">
                <label for="confirmdelete">Seguro que quieres BORRAR la {{"$bike->marca $bike->modelo"}}: </label>

                <input type="submit" alt="Borrar" title="borrar" class="btn btn-danger m-4" value="Borrar" id="confirmdelete">

            </form>

        
        <div class="btn-group" role="group" aria-label="Links">
        <a href="{{url('/')}}" class="btn btn-primary m-2">Inicio</a>
        <a href="{{route('bikes.index')}}" class="btn btn-primary m-2">Garaje</a>
        </div>

    </main>

    <!-- PARTE INFERIOR -->
    <footer class="footer mt-auto py-3">
        <div class="container text-center">
            <p class="text-muted">Aplicación creada por Cristian Castro como ejemplo de clase desarrollada y haciendo uso de Bootstrap y Laravel.</p>
        </div>
    </footer>

    <!-- Scripts de Bootstrap (jQuery primero, luego Popper.js, luego Bootstrap JS) -->
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/popper.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
</body>

</html>