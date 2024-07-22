@extends('layouts.master')

@section('contenido')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif
                    @auth
                    <p><b>Nombre: </b> {{ Auth::user()->name }}</p>
                    <p><b>Teléfono: </b> {{ Auth::user()->phone }}</p>
                    <p><b>Dirección: </b> {{ Auth::user()->direccion }}</p>
                    <p><b>Correo: </b> {{ Auth::user()->email }}</p>
                    <p><b>Fecha de alta: </b> {{ Auth::user()->created_at }}</p>
                    @endauth
                </div>
            </div>
        </div>
    </div>
</div>
<br><br>
<h2>Mis motos</h2>
<div class="container">
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
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
                <td>{{ $bike->id }}</td>
                <td class="text-start d-flex justify-content-center">
                    <img class="rounded" style="max-width: 90px;"
                        src="{{ $bike->imagen ? asset('storage/' . config('filesystems.bikesImageDir')) . '/' . $bike->imagen : asset('storage/' . config('filesystems.bikesImageDir')) . '/default.png' }}"
                        alt="Imagen de {{ $bike->marca }} {{ $bike->modelo }}"
                        title="Imagen de {{ $bike->marca }} {{ $bike->modelo }}">
                </td>
                <td>{{ $bike->marca }}</td>
                <td>{{ $bike->modelo }}</td>
                <td>{{ $bike->matricula }}</td>
                <td style="background-color: {{ $bike->color }}">{{ $bike->color }}</td>
                <td class="text-center">
                    <a href="{{ route('bikes.show', $bike->id) }}" class="btn btn-info btn-sm">
                        <img height="20" width="20" src="{{ asset('images/buttons/show.png') }}" alt="Ver detalles"
                            title="Ver detalles">
                    </a>
                    @auth
                    @if (Auth::user()->can('update', $bike))
                    <a href="{{ route('bikes.edit', $bike->id) }}" class="btn btn-warning btn-sm">
                        <img height="20" width="20" src="{{ asset('images/buttons/update.png') }}" alt="Modificar"
                            title="Modificar">
                    </a>
                    @endif
                    @can('update', $bike)
                    <a href="{{ route('bikes.delete', $bike->id) }}" class="btn btn-danger btn-sm">
                        <img height="20" width="20" src="{{ asset('images/buttons/delete.png') }}" alt="Eliminar"
                            title="Eliminar">
                    </a>
                    @endcan
                    @endauth
                </td>
            </tr>
            @endforeach
            @if ($bikes->isEmpty())
            <tr>
                <td colspan="7">No hay bicicletas registradas.</td>
            </tr>
            @endif
        </tbody>
    </table>

    @if(count($deletedBikes))
    <h3 class="mt-4">Motos borradas</h3>
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Imagen</th>
                <th>Marca</th>
                <th>Modelo</th>
                <th>Matrícula</th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($deletedBikes as $bike )
            <tr>
                <td><b>#{{$bike->id}}</b></td>
                <td class="text-center" style="max-width: 80px">
                    <img class="rounded" style="max-width: 80%"
                        alt="Imagen de {{$bike->marca}} {{$bike->modelo}}"
                        src="{{$bike->imagen ? asset('storage/'.config('filesystems.bikesImageDir')).'/'. $bike->imagen : asset('storage/'.config('filesystems.bikesImageDir')).'/default.jpg' }}">
                </td>
                <td>{{$bike->marca}}</td>
                <td>{{$bike->modelo}}</td>
                <td>{{$bike->matricula}}</td>
                <td class="text-center">
                    <a href="{{route('bikes.restore', $bike->id)}}">
                        <button class="btn btn-success">Restaurar</button>
                    </a>
                </td>
                <td class="text-center">
                    <a onclick='if(confirm("¿ Estas seguro ?"))
                        this.nextElementSibling.submit();'>
                        <button class="btn btn-danger">Eliminar</button>
                    </a>
                    <form method="POST" action="{{route('bikes.purge')}}">
                        @csrf
                        <input name="_method" type="hidden" value="DELETE">
                        <input name="bike_id" type="hidden" value="{{$bike->id}}">  
                    
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @endif
</div>
@endsection

