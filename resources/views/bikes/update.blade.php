@extends('layouts.master')

@section('titulo', "Mostrar $bike->marca $bike->modelo")
<!-- Contenido -->

@section('contenido')


    <form class="my-2 border p-5" method="POST" action="{{ route('bikes.update', $bike->id) }}">
        {{ csrf_field() }}
        <input name="_method" type="hidden" value="PUT">

        <div class="form-group row">
            <label for="inputMarca" class="col-sm-2 col-form-label">Marca</label>
            <input name="marca" value="{{ $bike->marca }}" type="text" class="up form-control col-sm-10"
                id="inputMarca" placeholder="Marca" maxlength="255" required="required">
        </div>

        <div class="form-group row">
            <label for="inputModelo" class="col-sm-2 col-form-label">Modelo</label>
            <input name="modelo" value="{{ $bike->modelo }}" type="text" class="up form-control col-sm-10"
                id="inputModelo" placeholder="Modelo" maxlength="255" required="required">
        </div>
        <div class="form-group row">
            <label for="inputprecio" class="col-sm-2 col-form-label">Precio</label>
            <input name="precio" value="{{ $bike->precio }}" type="number" class="form-control col-sm-4" id="precio"
                min="0" step="0.01" required>
        </div>

        <div class="form-group row">
            <label for="inputkms" class="col-sm-2 col-form-label">KMS</label>
            <input name="kms" value="{{ $bike->kms }}" type="number" class="form-control col-sm-4" id="inputkms"
                required>
        </div>


        <div class="form-group row">
            <div class="form-check">
                <input name="matriculada" class="form-check-input" value="1" type="checkbox"
                    {{ $bike->matriculada ? 'checked' : '' }}>
                <label for="matriculada">Matriculada</label>
            </div>
        </div>


        <div class="form-group row">
            <button type="submit" class="btn btn-success mt-5 m-2">Guardar</button>
            <button type="reset" class="btn btn-secondary m-2">Borrar</button>
        </div>
    </form>


    <div class="text-end my-3">

        <div class="btn-group mx-2">
            <a class="mx-2" href="{{ route('bikes.edit', $bike->id) }}">
                <img height="40" width="40" src="{{ asset('images/buttons/update.png') }}" alt="Modificar"
                    title="Modificar">
            </a>

            <a class="mx-2" href="{{ route('bikes.delete', $bike->id) }}">
                <img height="40" width="40" src="{{ asset('images/buttons/delete.png') }}" alt="Modificar"
                    title="Modificar">
            </a>

        </div>
    </div>
@endsection



@section('enlaces')
    @parent
    <a href="{{ route('bikes.index') }}" class="btn btn-primary m-2">Garaje</a>
@endsection
