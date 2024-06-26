@extends('layouts.master')

@section('titulo', 'Portada Larabikes')



<!-- CONTENIDO -->
@section('contenido')
    <div class="jumbotron">
        <div class="container">
            <h1 class="display-4">Primer ejemplo con Laravel</h1>
            <p class="lead">Bienvenido a LaraBikes. Implementación de un <strong>CRUD</strong> de motos.</p>
            <hr class="my-4">
            <div class="row">
                <div class="col-12 col-md-8 offset-md-2">
                    <img class="img-fluid rounded" src="{{ asset('images/bikes/moto_recien_estrenada.jpg') }}"
                        alt="Moto recién estrenada">
                </div>
            </div>
        </div>
    </div>
@endsection




@section('enlaces')
@endsection

<!-- Scripts de Bootstrap (jQuery primero, luego Popper.js, luego Bootstrap JS) -->
<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{ asset('js/popper.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
</body>

</html>
