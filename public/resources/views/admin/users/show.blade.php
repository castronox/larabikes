@extends('layouts.master')
@section('titulo', "Detalles del usuario $user->name")
@section('contenido')
    <div class="row">
        <table class="col-8 table table-striped table-bordered">
            <tr>
                <td>ID</td>
                <td>{{ $user->id }}</td>
            </tr>
            <tr>
                <td>Nombre</td>
                <td>{{ $user->name }}</td>
            </tr>
            <tr>
                <td>Email</td>
                <td><a href="mailto:{{ $user->email }}">{{ $user->email }}</a></td>
            </tr>
            <tr>
                <td>Fecha de alta</td>
                <td>{{ $user->created_at }}</td>
            </tr>
            <tr>
                <td>Fecha de Verificación</td>
                <td>{{ $user->verified_at ?? 'Sin verificar' }}</td>
            </tr>
            <tr>
                <td>Roles</td>
                <td>
                    @foreach ($user->roles as $rol)
                        - {{ $rol->role }}
                    @endforeach
                </td>
            </tr>
        </table>

        <figure class="col-4">
            <img class="rounded img-fluid" alt="Imagen de usuario {{ $user->name }}"
                src="{{ asset('storage/images/users/default.jpg') }}">
            <figcaption class="figure-caption text-center">
                {{ $user->name }}
            </figcaption>
        </figure>
    </div>
@endsection
@section('enlaces')
    @parent
    <a href="{{ route('admin.users') }}" class="btn btn-primary m-2">Lista de usuarios</a>
@endsection
