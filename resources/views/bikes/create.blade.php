@php($pagina = 'nuevamoto')
@extends('layouts.master')

@section('titulo', 'Nueva Moto')

@section('contenido')
    <form class="my-2 border p-5 bg-light shadow-sm" method="POST" action="{{ route('bikes.store') }}"
        enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="form-group row">
            <label for="inputMarca" class="col-sm-2 col-form-label">Marca</label>
            <div class="col-sm-10">
                <input name="marca" type="text" class="form-control" id="inputMarca" placeholder="Marca" maxlength="255"
                    required value="{{ old('marca') }}">
            </div>
        </div>

        <div class="form-group row">
            <label for="inputModelo" class="col-sm-2 col-form-label">Modelo</label>
            <div class="col-sm-10">
                <input name="modelo" type="text" class="form-control" id="inputModelo" placeholder="Modelo"
                    maxlength="255" required value="{{ old('modelo') }}">
            </div>
        </div>

        <div class="form-group row">
            <label for="inputkms" class="col-sm-2 col-form-label">Kilómetros Recorridos</label>
            <div class="col-sm-4">
                <input name="kms" type="number" class="form-control" id="inputkms" placeholder="kms" required
                    value="{{ old('kms') }}">
            </div>
        </div>

        <div class="form-group row">
            <label for="inputPrecio" class="col-sm-2 col-form-label">Precio</label>
            <div class="col-sm-4">
                <input name="precio" type="number" class="form-control" id="inputPrecio" placeholder="precio"
                    maxlength="11" required min="0" step="0.01" value="{{ old('precio') }}">
            </div>
        </div>

        <div class="form-group row">
            <label for="inputImagen" class="col-sm-2 col-form-label">Imagen</label>
            <div class="col-sm-10">
                <input name="imagen" type="file" class="form-control-file" id="inputImagen">
                <img class="rounded mt-3" style="max-width: 400px"
                    src="{{ isset($bike) && $bike->imagen
                        ? asset('storage/' . config('filesystems.bikesImageDir') . '/' . $bike->imagen)
                        : asset('storage/' . config('filesystems.bikesImageDir') . '/default.png') }}"
                    alt="Imagen de {{ $bike->marca ?? 'marca desconocida' }} {{ $bike->modelo ?? 'modelo desconocido' }}"
                    title="Imagen de {{ $bike->marca ?? 'marca desconocida' }} {{ $bike->modelo ?? 'modelo desconocido' }}">
            </div>
        </div>

        {{-- Actualización para el color --}}
        <div class="form-group row">
            <div class="col-sm-6">
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="chkColor">
                    <label class="form-check-label" for="chkColor">Indicar el color</label>
                </div>
            </div>
            <div class="col-sm-1">
                <label for="inputColor" class="form-label">Color</label>
                <input name="color" type="color" class="form-control form-control-color" id="inputColor" value="{{old('color') ?? '#FFFFFF'}}">
            </div>
        </div>
        <script>
            document.getElementById('inputColor').disabled = !document.getElementById('chkColor').checked;
            document.getElementById('chkColor').onchange = function(){
                document.getElementById('inputColor').disabled = !this.checked;
            }
        </script>

        <div class="form-group row my-3">
            <div class="form-check col-sm-6">
                <div class="form-check">
                    <input name="matriculada" value="1" class="form-check-input" type="checkbox" id="chkMatriculada"
                        {{ empty(old('matriculada')) ? '' : 'checked' }}>
                    <label class="form-check-label" for="chkMatriculada">Matriculada</label>
                </div>
            </div>
            <div class="col-sm-6">
                <label for="inputMatricula" class="form-label">Matrícula</label>
                <input name="matricula" type="text" class="form-control" id="inputMatricula" maxlength="7" value="{{old('matricula')}}">

                <label for="confirmMatricula" class="col-sm-2 form-label">Repetir:</label>
                <input name="matricula_confirmation" type="text" class="up form-control" id="confirmMatricula" maxlength="7" value="{{old('matricula_confirmation')}}">
            </div>
        </div>
        <script>
            inputMatricula.disabled = !chkMatricula.checked;
            confirmMatricula.disabled = !chkMatriculada.checked;

            chkMatriculada.onchange = function(){
                inputMatricula.disabled = !chkMatriculada.checked;
                confirmMatricula.disabled = !chkMatriculada.checked
            }
        </script>

        <div class="form-group row">
            <div class="col-sm-10 offset-sm-2">
                <button type="submit" class="btn btn-success">Guardar</button>
                <button type="reset" class="btn btn-secondary">Borrar</button>
            </div>
        </div>
    </form>
@endsection

@section('enlaces')
    @parent
    <a href="{{ route('bikes.index') }}" class="btn btn-primary m-2">Garaje</a>
@endsection
