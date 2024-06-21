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

        .table th,
        .table td {
            vertical-align: middle;
        }

        .table th {
            background-color: #343a40;
            color: #fff;
        }

        .table-striped tbody tr:nth-of-type(odd) {
            background-color: rgba(0, 0, 0, .05);
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
                        <a class="nav-link" href="{{ url('/') }}">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('bikes.index') }}">Garaje</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('bikes.create') }}">Nueva Moto</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- PARTE CENTRAL -->
    <h1 class="my-2">Gestor de motos de LaraBikes</h1>

    <main>
        <h2>Listado de motos</h2>

        @if (Session::has('success'))
            <div class="alert alert-success">
                {{ Session::get('success') }}
            </div>
        @endif
        <div class="row inline-items">
            <div class="col-sm text-start">{{ $bikes->links() }}</div>
            <div class="col-sm text-end">
                <p>Nueva moto <a href="{{ route('bikes.create') }}" class="btn btn-success ml-2">+</a></p>
            </div>
        </div> 

        
        
        

        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Marca</th>
                    <th>Modelo</th>
                    <th>Operaciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($bikes as $bike)
                    <tr>
                        <td>{{ $bike->id }}</td>
                        <td>{{ $bike->marca }}</td>
                        <td>{{ $bike->modelo }}</td>
                        <td class="text-center">
                            <a href="{{ route('bikes.show', $bike->id) }}" class="btn btn-info btn-sm">
                                <img height="20" width="20" src="{{ asset('images/buttons/show.png') }}" alt="Ver detalles"
                                    title="Ver detalles">
                            </a>
                            <a href="{{ route('bikes.edit', $bike->id) }}" class="btn btn-warning btn-sm">
                                <img height="20" width="20" src="{{ asset('images/buttons/update.png') }}" alt="Modificar"
                                    title="Modificar">
                            </a>
                            <a href="{{ route('bikes.delete', $bike->id) }}" class="btn btn-danger btn-sm">
                                <img height="20" width="20" src="{{ asset('images/buttons/delete.png') }}" alt="Eliminar"
                                    title="Eliminar">
                            </a>
                        </td>
                    </tr>
                @endforeach
                <tr>
                    <td colspan="4">Mostrando {{ sizeof($bikes) }} de {{ $total }}</td>
                </tr>
            </tbody>
        </table>

        <div class="btn-group" role="group" aria-label="Links">
            <a href="{{ url('/') }}" class="btn btn-primary mr-2">Inicio</a>
            
        </div>
        <br><br><br>

        <script>
            var motos={!! json_enconde($bikes) !!};
            var indice= 0;
            setInterval(function() => {
                info.innerHTML = motos.data[inidice].marca+
            }, 2000);
        </script>
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
