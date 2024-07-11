@auth
@extends('layouts.master')

@section('titulo', "Mostrar $bike->marca $bike->modelo")

@section('contenido')

<form class="my-2 border p-5" method="POST" enctype="multipart/form-data" action="{{ route('bikes.update', $bike->id) }}">
    {{ csrf_field() }}
    <input name="_method" type="hidden" value="PUT">

    <div class="form-group row">
        <label for="inputMarca" class="col-sm-2 col-form-label">Marca</label>
        <div class="col-sm-10">
            <input name="marca" value="{{ $bike->marca }}" type="text" class="form-control" id="inputMarca" placeholder="Marca" maxlength="255" required="required">
        </div>
    </div>

    <div class="form-group row">
        <label for="inputModelo" class="col-sm-2 col-form-label">Modelo</label>
        <div class="col-sm-10">
            <input name="modelo" value="{{ $bike->modelo }}" type="text" class="form-control" id="inputModelo" placeholder="Modelo" maxlength="255" required="required">
        </div>
    </div>

    <div class="form-group row">
        <label for="inputPrecio" class="col-sm-2 col-form-label">Precio</label>
        <div class="col-sm-4">
            <input name="precio" value="{{ $bike->precio }}" type="number" class="form-control" id="inputPrecio" min="0" step="0.01" required>
        </div>
    </div>

    <div class="form-group row">
        <label for="inputKms" class="col-sm-2 col-form-label">KMS</label>
        <div class="col-sm-4">
            <input name="kms" value="{{ $bike->kms }}" type="number" class="form-control" id="inputKms" required>
        </div>
    </div>

    <div class="form-group row my-3">
        <div class="col-sm-9">
            <label for="inputImagen" class="col-form-label">
                {{ $bike->imagen ? 'Sustituir' : 'Añadir' }} imagen
            </label>
            <input name="imagen" type="file" class="form-control-file" id="inputImagen">

            @if($bike->imagen)
            <div class="form-check my-3">
                <input name="eliminarimagen" type="checkbox" class="form-check-input" id="inputEliminar">
                <label for="inputEliminar" class="form-check-label">Eliminar imagen</label>
            </div>
            <script>
                inputEliminar.onchange = function() {
                    inputImagen.disabled = this.checked;
                }
            </script>
            @endif
        </div>
        <div class="col-sm-3">
            <label>Imagen actual:</label>
            <img class="rounded img-thumbnail my-3" alt="Imagen de {{ $bike->marca }} {{ $bike->modelo }}" title="Imagen de {{ $bike->marca }} {{ $bike->modelo }}" src="{{ $bike->imagen ? asset('storage/' . config('filesystems.bikesImageDir') . '/' . $bike->imagen) : asset('storage/' . config('filesystems.bikesImageDir') . '/default.png') }}">
        </div>
    </div>

    <div class="form-group row my-3">
        <div class="form-check col-sm-6">
            <input name="matriculada" type="checkbox" value="1" class="form-check-input" id="chkMatriculada" {{ $bike->matriculada ? 'checked' : '' }}>
            <label for="chkMatriculada" class="form-check-label">Matriculada</label>
        </div>
        <div class="col-sm-6">
            <label for="inputMatricula" class="col-form-label">Matrícula</label>
            <input name="matricula" type="text" class="form-control" id="inputMatricula" maxlength="7" value="{{ $bike->matricula }}">
        </div>
    </div>
    <script>
        inputMatricula.disabled = !chkMatriculada.checked;

        chkMatriculada.onchange = function() {
            inputMatricula.disabled = !chkMatriculada.checked;
        }
    </script>

    <div class="form-group row">
        <div class="form-check col-sm-6">
            <input type="checkbox" class="form-check-input" id="chkColor" {{ $bike->color ? 'checked' : '' }}>
            <label for="chkColor" class="form-check-label">Indicar el color</label>
        </div>
        <div class="col-sm-6">
            <label for="inputColor" class="col-form-label">Color</label>
            <input name="color" type="color" class="form-control form-control-color" id="inputColor" value="{{ $bike->color ?? '#FFFFFF' }}">
        </div>
    </div>

    <script>
        inputColor.disabled = !chkColor.checked;

        chkColor.onchange = function() {
            inputColor.disabled = !chkColor.checked;
        }
    </script>

    <div class="form-group row">
        <button type="submit" class="btn btn-success mt-5 m-2">Guardar</button>
    </div>
</form>

<div class="text-end my-3">
    <div class="btn-group mx-2">
        <a class="mx-2" href="{{ route('bikes.edit', $bike->id) }}">
            <img height="40" width="40" src="{{ asset('images/buttons/update.png') }}" alt="Modificar" title="Modificar">
        </a>

        <a class="mx-2" href="{{ route('bikes.delete', $bike->id) }}">
            <img height="40" width="40" src="{{ asset('images/buttons/delete.png') }}" alt="Eliminar" title="Eliminar">
        </a>
    </div>
</div>
@endsection

@section('enlaces')
@parent
<a href="{{ route('bikes.index') }}" class="btn btn-primary m-2">Garaje</a>
@endsection

@endauth