@php($pagina='portada')

@extends('layouts.master')

@section('titulo', 'Portada Larabikes')

<!-- CONTENIDO -->
@section('contenido')
    <div class="jumbotron">
        <div class="container">
            <h1 class="display-4">Primer ejemplo con Laravel</h1>
            <p class="lead">Bienvenido a LaraBikes. Implementación de un <strong>CRUD</strong> de motos.</p>
            <hr class="my-4">

            <!-- Carrusel de Bootstrap -->
            <div id="bikeCarousel" class="carousel slide" data-ride="carousel" data-interval="2000">
                <div class="carousel-inner">
                    @foreach($bikes as $index => $bike)
                        <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                            <img class="d-block w-100 mx-auto"  style="max-width: 800px; max-height: 600px; object-fit: contain;"  
                                 src="{{ $bike->imagen ? asset('storage/' . config('filesystems.bikesImageDir')) . '/' . $bike->imagen : asset('storage/' . config('filesystems.bikesImageDir')) . '/default.png' }}" 
                                 alt="Imagen de {{$bike->marca}} {{$bike->modelo}}" 
                                 title="Imagen de {{$bike->marca}} {{$bike->modelo}}">
                            <div class="carousel-caption d-none d-md-block">
                                <h5>{{ $bike->nombre }}</h5>
                                <p>{{ $bike->descripcion }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
                <a class="carousel-control-prev" href="#bikeCarousel" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Anterior</span>
                </a>
                <a class="carousel-control-next" href="#bikeCarousel" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Siguiente</span>
                </a>
            </div>
        </div>
    </div>
@endsection

@section('enlaces')
    <!-- Scripts de Bootstrap (jQuery primero, luego Popper.js, luego Bootstrap JS) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- Inicializar el carrusel de Bootstrap -->
    <script>
        $(document).ready(function(){
            $('#bikeCarousel').carousel({
                interval: 2000 // Cambia la imagen cada 2 segundos
            });
        });
    </script>
@endsection
