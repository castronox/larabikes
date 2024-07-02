@extends('layouts.master')

@section('titulo', "Confirmación de borrado de $bike->nombre $bike->modelo")


<!--CONTENIDO -->

@section('contenido')

    <form method="POST" class="my-2 border p-5" action="{{ URL::signedRoute('bikes.destroy', $bike->id) }}">
        {{ csrf_field() }}
        <input name="_method" type="hidden" value="DELETE">
        <label for="confirmdelete">Seguro que quieres BORRAR la {{ "$bike->marca $bike->modelo" }}: </label>

        <input type="submit" alt="Borrar" title="borrar" class="btn btn-danger m-4" value="Borrar" id="confirmdelete">

    </form>

@endsection

@section('enlaces')
    @parent
    <a href="{{ route('bikes.index') }}" class="btn btn-primary m-2">Garaje</a>
    <a href="{{ route('bikes.show', $bike->id) }}" class="btn btn-primary m-2">Garaje</a>
@endsection
