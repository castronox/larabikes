@auth
    

@extends('layouts.master')

@section('titulo', "Confirmación de borrado de $bike->nombre $bike->modelo")


<!--CONTENIDO -->

@section('contenido')

    <form method="POST" class="my-2 border p-5" action="{{ URL::temporarySignedRoute( 'bikes.destroy' , now()->addMinutes(1) , $bike->id) }}">


        {{ csrf_field() }}
        <input name="_method" type="hidden" value="DELETE">
        <label for="confirmdelete">Seguro que quieres BORRAR la {{ "$bike->marca $bike->modelo" }}: </label>

        <div class="form-group row">
            <label for="inputImagen" class="col-sm-2 col-form-label">Imagen</label>
            <input name="imagen" type="file" class="form-control-file col-sm-10" id="inputImagen">
            
                <img class="rounded mt-3 ml-10" style="max-width: 400px" 
                src="{{
                $bike->imagen?
                asset('storage/' . config('filesystems.bikesImageDir')) . '/' .$bike->imagen:
                asset('storage/' . config('filesystems.bikesImageDir')) . '/default.jpg'}}"
                alt="Imagen de {{$bike->marca}} {{$bike->modelo}}" title="Imagen de {{$bike->marca}} {{$bike->modelo}}">
            
        </div>

        <input type="submit" alt="Borrar" title="borrar" class="btn btn-danger m-4" value="Borrar" id="confirmdelete">

    </form>

@endsection

@section('enlaces')
    @parent
    <a href="{{ route('bikes.index') }}" class="btn btn-primary m-2">Garaje</a>
    <a href="{{ route('bikes.show', $bike->id) }}" class="btn btn-primary m-2">Garaje</a>
@endsection
@endauth