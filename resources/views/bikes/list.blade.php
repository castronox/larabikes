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
                            <img height="20" width="20" src="{{ asset('images/buttons/show.png') }}"
                                alt="Ver detalles" title="Ver detalles">
                        </a>
                        <a href="{{ route('bikes.edit', $bike->id) }}" class="btn btn-warning btn-sm">
                            <img height="20" width="20" src="{{ asset('images/buttons/update.png') }}"
                                alt="Modificar" title="Modificar">
                        </a>
                        <a href="{{ route('bikes.delete', $bike->id) }}" class="btn btn-danger btn-sm">
                            <img height="20" width="20" src="{{ asset('images/buttons/delete.png') }}"
                                alt="Eliminar" title="Eliminar">
                        </a>
                    </td>
                </tr>
            @endforeach
            <tr>
                <td colspan="4">Mostrando {{ sizeof($bikes) }} de {{ $total }}</td>
            </tr>
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
