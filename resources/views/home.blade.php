@extends('layouts.master')

@section('contenido')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif    
                    @auth
                        <p><b>Nombre: </b> {{Auth::user()->name}}</p>
                        <p><b>Teléfono: </b> {{Auth::user()->phone}}</p>
                        <p><b>Dirección: </b> {{Auth::user()->direccion}}</p>
                        <p><b>Correo: </b> {{Auth::user()->email}}</p>
                        <p><b>Fecha de alta: </b> {{Auth::user()->created_at}}</p>
                    @endauth
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
