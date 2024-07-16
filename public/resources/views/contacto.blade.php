@extends('layouts.master')
@section('titulo', 'Contactar con LaraBikes')
@section('contenido')
    <div class="container row">
        <form class="col-7 my-2 border p-4" method="POST" action="{{ route('contacto.email') }}" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="form-group row">
                <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                <input name="email" type="email" class="up form-control" id="inputEmail" placeholder="Email"
                    maxlength="255" required="required" value="{{ old('email') }}">
            </div>
            <div class="form-group row">
                <label for="inputNombre" class="col-sm-2 col-form-label">Nombre</label>
                <input name="nombre" type="text" class="up form-control" id="inputNombre" placeholder="Nombre"
                    maxlength="255" required="required" value="{{ old('nombre') }}">
            </div>
            <div class="form-group row">
                <label for="inputAsunto" class="col-sm-2 col-form-label"></label>
                <input name="asunto" type="text" class="up form-control" id="inputAsunto" placeholder="Asunto"
                    maxlength="255" required="required" value="{{ old('asunto') }}">
            </div>
            <div class="form-group row">
                <label for="" class="col-sm-2 col-form-label"></label>
                <textarea name="mensaje" class="up form-control" id="inputMensaje" maxlength="2550" required="required">{{ old('mensaje') }}</textarea>
            </div>
            <div class="form-group row my-4">
                <label for="inputFichero" class="form-label">Fichero (pdf):</label>
                <input name="fichero" type="file" class="form-control-file" accept="application/pdf" id="inputFichero">

            </div>
            <div class="form-group-row">
                <button type="submit" class="btn btn-success m-2 mt-5">Enviar</button>
                <button type="reset" class="btn btn-success m-2 mt-5">Reset</button>
            </div>
        </form>

        <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2985.661127465928!2d2.0555170757736994!3d41.554933971279105!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x12a493650ae03931%3A0xee4ac6c8e8372532!2sCentre%20d&#39;Innovaci%C3%B3%20i%20Formaci%C3%B3%20Ocupacional%20(CIFO)%20de%20Sabadell!5e0!3m2!1ses!2ses!4v1720079139549!5m2!1ses!2ses"
            width="300" height="300" style="border:0;" allowfullscreen="" loading="lazy"
            referrerpolicy="no-referrer-when-downgrade" class="col-5 my-2 border p-3">
        </iframe>
    </div>
@endsection

@section('enlaces')
    @parent 
    <a href="{{route('bikes.index')}}" class="btn btn-primary m-2">Garaje</a>
@endsection