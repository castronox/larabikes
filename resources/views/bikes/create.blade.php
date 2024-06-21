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
                        <a class="nav-link" href="{{ url('/') }}">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('bikes.index') }}">Garaje</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('bikes.create') }}">Nueva Moto</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- PARTE CENTRAL -->
    <h1 class="my-2">Gestor de motos de LaraBikes</h1>
    <main>
        <h2>Nueva Moto</h2>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form class="my-2 border p-5 bg-light shadow-sm" method="POST" action="{{ route('bikes.store') }}">
            {{ csrf_field() }}
            <div class="form-group row">
                <label for="inputMarca" class="col-sm-2 col-form-label">Marca</label>
                <div class="col-sm-10">
                    <input name="marca" type="text" class="form-control" id="inputMarca" placeholder="Marca" maxlength="255" required value="{{ old('marca') }}">
                </div>
            </div>

            <div class="form-group row">
                <label for="inputModelo" class="col-sm-2 col-form-label">Modelo</label>
                <div class="col-sm-10">
                    <input name="modelo" type="text" class="form-control" id="inputModelo" placeholder="Modelo" maxlength="255" required value="{{ old('modelo') }}">
                </div>
            </div>

            <div class="form-group row">
                <label for="inputkms" class="col-sm-2 col-form-label">Kilómetros Recorridos</label>
                <div class="col-sm-4">
                    <input name="kms" type="number" class="form-control" id="inputkms" placeholder="kms" required value="{{ old('kms') }}">
                </div>
            </div>

            <div class="form-group row">
                <label for="inputPrecio" class="col-sm-2 col-form-label">Precio</label>
                <div class="col-sm-4">
                    <input name="precio" type="number" class="form-control" id="inputPrecio" placeholder="precio" maxlength="11" required min="0" step="0.01" value="{{ old('precio') }}">
                </div>
            </div>

            <div class="form-group row">
                <div class="col-sm-2"> </div>
                <div class="col-sm-10">
                    <div class="form-check">
                        <input name="matriculada" value="1" class="form-check-input" type="checkbox" id="inputMatriculada" {{ empty(old('matriculada')) ? '' : 'checked' }}>
                        <label class="form-check-label" for="inputMatriculada">Matriculada</label>
                    </div>
                </div>
            </div>

            <div class="form-group row">
                <div class="col-sm-10 offset-sm-2">
                    <button type="submit" class="btn btn-success">Guardar</button>
                    <button type="reset" class="btn btn-secondary">Borrar</button>
                </div>
            </div>
        </form>

        <div class="btn-group mt-3" role="group" aria-label="Links">
            <a href="{{ url('/') }}" class="btn btn-primary">Inicio</a> &nbsp;
            <a href="{{ route('bikes.index') }}" class="btn btn-primary">Garaje</a>
        </div>
        <br><br>
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
