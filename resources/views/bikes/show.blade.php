@extends('layouts.master')

@section('titulo', "Mostrar $bike->marca $bike->modelo")
<!-- Contenido -->


@section('contenido')

<table class="table table-striped table-bordered">
    <tr>
        <td>ID</td>
        <td>{{$bike->id}}</td>
    </tr>

    <tr>
        <td>Marca</td>
        <td>{{$bike->marca}}</td>
    </tr>
    <tr>
        <td>Modelo</td>
        <td>{{$bike->modelo}}</td>
    </tr>

    <tr>
        <td>Precio</td>
        <td>{{$bike->precio}}</td>
    </tr>
    <tr>
        <td>KMS</td>
        <td>{{$bike->kms}}</td>
    </tr>

    <tr>
        <td>Matriculada</td>
        <td>{{$bike->matriculada? 'SI' : 'NO'}}</td>
    </tr>

    <tr>
        <td>Imagen</td>
        <td class="text-start" >
            <img class="rounded" style="max-width: 400px" 
            src="{{
            $bike->imagen?
            asset('storage/' . config('filesystems.bikesImageDir')) . '/' .$bike->imagen:
            asset('storage/' . config('filesystems.bikesImageDir')) . '/default.png'}}"
            alt="Imagen de {{$bike->marca}} {{$bike->modelo}}" title="Imagen de {{$bike->marca}} {{$bike->modelo}}">
        </td>
    </tr>
</table>


<div class="text-end my-3">

    <div class="btn-group mx-2">
        <a class="mx-2" href="{{route('bikes.edit', $bike->id)}}">
            <img height="40" width="40" src="{{asset('images/buttons/update.png')}}" alt="Modificar" title="Modificar">
        </a>

        <a class="mx-2" href="{{route('bikes.delete', $bike->id)}}">
            <img height="40" width="40" src="{{asset('images/buttons/delete.png')}}" alt="Modificar" title="Modificar">
        </a>

    </div>
</div>

@endsection

@section('enlaces')
    @parent
<a href="{{route('bikes.index')}}" class="btn btn-primary m-2">Garaje</a>

@endsection


    