@extends('layouts.master')

@section('titulo', "Mostrar $bike->marca $bike->modelo")
<!-- Contenido -->

@section('contenido')


    <form class="my-2 border p-5" method="POST" enctype="multipart/form-data" action="{{ route('bikes.update', $bike->id) }}">
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

        <div class="form-group row my-3" >
            <div class="col-sm-9" >
                <label for="inputImagen" class="col-sm-2 col-form-label">
                    {{$bike->imagen? 'Sustituir' : 'Añadir'}} imagen
                </label>
                <input name="imagen" type="file" class="form-control-file" id="inputImagen">

                @if($bike->imagen)
                <div class="form-check my-3">
                    <input name="eliminarimagen" type="checkbox" class="form-check-input" id="inputEliminar">
                    <label for="inputEliminar" class="form-check-label">Eliminar imagen</label>
                </div>
                <script>
                    inputEliminar.onchange = function(){
                        inputImagen.disabled = this.checked;
                    }
                </script>
                @endif
            </div>
            <div class="col-sm-3">
                <label>Imagen actual:</label>
                <img class="rounded img-thumbnail my-3" alt="Imagen de {{$bike->marca}} {{$bike->modelo}}" title="Imagen de {{$bike->marca}} {{$bike->modelo}}" 
                src="{{
                $bike->imagen?
                asset('storage/'.config('filesystems.bikesImageDir')) . '/' . $bike->imagen:
                asset('storage/'.config('filesystems.bikesImageDir')) . '/default.png'
                }}">

            </div>
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
