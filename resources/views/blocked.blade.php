@extends('layouts.master')
@section('contenido')


<div class="container row mt-2">
    <div class="col-10 alert alert-danger p-4">
        <p>Has sido <b>BLOQUEADO</b> por un administrador.</p>
        <p>Si no estás de acuerdo o quieres conocer los motivvos, contacta mediante el 
            <a href="{{route('contacto')}}">formulario de contacto</a>.
        </p>
    </div>

    <figure class="col-2">
        <img class="rounded img-fluid" src="{{asset('/images/template/blocked.png')}}" alt="Usuario bloqueado">
        <figcaption class="figure-caption text-center">Usuario bloqueado</figcaption>
    </figure>
</div>

@endsection