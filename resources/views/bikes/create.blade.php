@extends('layouts.master')

@section('titulo', 'Nueva Moto')

@section('contenido')
    <form class="my-2 border p-5 bg-light shadow-sm" method="POST" action="{{ route('bikes.store') }}">
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
            <div class="col-sm-2"> </div>
            <div class="col-sm-10">
                <div class="form-check">
                    <input name="matriculada" value="1" class="form-check-input" type="checkbox" id="inputMatriculada"
                        {{ empty(old('matriculada')) ? '' : 'checked' }}>
                    <label class="form-check-label" for="inputMatriculada">Matriculada</label>
                </div>
            </div>
        </div>

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
<br><br>
</main>


</body>

</html>
