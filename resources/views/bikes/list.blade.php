@php($pagina='listamotos')

@extends('layouts.master')

@section('titulo', 'Lista de Motos')


<!-- CONTENIDO -->


@section('contenido')
    <div class="row inline-items">
        <div class="col-sm text-start">{{ $bikes->links() }}</div>
        <div class="col-sm text-end">
            <p>Nueva moto <a href="{{ route('bikes.create') }}" class="btn btn-success ml-2">+</a></p>
        </div>
    </div>

    <form method="GET" class="col-6 row" action="{{route('bikes.search')}}">

        <input name="marca" type="text" class="col form-control mr-2 mb-2" placeholder="Marca" maxlength="16" value="{{ $marca ?? '' }}">
        <input name="modelo" type="text" class="col form-control mr-2 mb-2" placeholder="Modelo" maxlength="16" value="{{ $modelo ?? '' }}">

        <button type="submit" class="col btn btn-primary mr-2 mb-2">Buscar</button>

        <a href="{{ route('bikes.index') }}">
            <button type="button" class="col btn btn-primary mb-2" >Quitar filtro</button>
        </a>
    </form>


    <table class="table table-striped table-bordered">
        <thead class="">
            <tr class="">
                <th>ID</th>
                <th>Foto</th>
                <th>Marca</th>
                <th>Modelo</th>
                <th>Matricula</th>
                <th>Color</th>
                <th>Operaciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($bikes as $bike)
                <tr>
                    <td class="">{{ $bike->id }}</td>                  
                        
                        <td class="text-start d-flex justify-content-center" >
                            <img class="rounded " style="max-width: 90px" 
                            src="{{
                            $bike->imagen?
                            asset('storage/' . config('filesystems.bikesImageDir')) . '/' .$bike->imagen:
                            asset('storage/' . config('filesystems.bikesImageDir')) . '/default.png'}}"
                            alt="Imagen de {{$bike->marca}} {{$bike->modelo}}" title="Imagen de {{$bike->marca}} {{$bike->modelo}}">
                        </td>
                    
                    <td>{{ $bike->marca }}</td>
                    <td>{{ $bike->modelo }}</td>
                    <td>{{ $bike->matricula}}</td>
                    <td style="background-color:{{$bike->color}}">{{$bike->color}}</td>
                    <td class="text-center">
                        <a href="{{ route('bikes.show', $bike->id) }}" class="btn btn-info btn-sm">
                            <img height="20" width="20" src="{{ asset('images/buttons/show.png') }}"
                                alt="Ver detalles" title="Ver detalles">
                        </a>
                        @auth
                        <a href="{{ route('bikes.edit', $bike->id) }}" class="btn btn-warning btn-sm">
                            <img height="20" width="20" src="{{ asset('images/buttons/update.png') }}"
                                alt="Modificar" title="Modificar">
                        </a>
                        <a href="{{ route('bikes.delete', $bike->id) }}" class="btn btn-danger btn-sm">
                            <img height="20" width="20" src="{{ asset('images/buttons/delete.png') }}"
                                alt="Eliminar" title="Eliminar">
                        </a>
                        @endauth
                    </td>
                </tr>
            
            @if($loop->last)
            <tr>
                <td colspan="7">Mostrando {{ sizeof($bikes) }} de {{ $bikes->total() }}</td>
            </tr>
            @endif
            @endforeach
        </tbody>
    </table>

    <script>
        var motos = {!! json_encode($bikes) !!};
        var indice = 0;

        setInterval(function() {
            info.innerHTML = motos.data[indice].marca + ' ' + motos.data[indice].modelo;
            indice = ++indice % motos.data.length;
        }, 2000);
    </script>

    <p>Estas són algunas de nuestras motos: <span id= "info"></span></p>
@endsection



@section('enlaces')
@endsection
