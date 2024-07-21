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
                        <span class="d-inline-block w-50">- {{ $rol->role }}</span>
                        <form class="d-inline-block p-1" method="POST" action="{{ route('admin.user.removeRole') }}">
                            @csrf
                            <input type="hidden" name="_method" value="DELETE">
                            <input type="hidden" name="user_id" value="{{ $user->id }}">
                            <input type="hidden" name="role_id" value="{{ $rol->id }}">
                            <input type="submit" class="btn" value="Eliminar">
                        </form>
                    @endforeach
                </td>
            </tr>
            <tr>
                <td>Añadir rol</td>

                <td>
                    <form method="POST" action="{{ route('admin.user.setRole') }}">
                        @csrf
                        <input type="hidden" name="_method" value="POST">
                        <input type="hidden" name="user_id" value="{{ $user->id }}">
                        <select class="form-control w-50 d-inline" name="role_id">
                            @foreach ($user->remainingRoles() as $rol)
                                <option value="{{ $rol->id }}">{{ $rol->role }}</option>
                            @endforeach
                        </select>
                        <input type="submit" class="btn btn-success px-3 ml-1" value="Añadir">
                    </form>
                </td>
            </tr>
        </table>

        <figure class="col-4">
            <img class="rounded img-fluid" alt="Imagen de usuario {{ $user->name }}"
                src="{{ asset('storage/images/users/default.png') }}">
            <figcaption class="figure-caption text-center">
                {{ $user->name }}
            </figcaption>
        </figure>
    </div>

    <h2>Mis motos</h2>
    <div class="container">
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Foto</th>
                    <th>Marca</th>
                    <th>Modelo</th>
                    <th>Matricula</th>
                    <th>Color</th>
                    <th>Operaciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($bikes as $bike)
                    <tr>
                        <td>{{ $bike->id }}</td>
                        <td class="text-start d-flex justify-content-center">
                            <img class="rounded" style="max-width: 90px;"
                                src="{{ $bike->imagen ? asset('storage/' . config('filesystems.bikesImageDir')) . '/' . $bike->imagen : asset('storage/' . config('filesystems.bikesImageDir')) . '/default.png' }}"
                                alt="Imagen de {{ $bike->marca }} {{ $bike->modelo }}"
                                title="Imagen de {{ $bike->marca }} {{ $bike->modelo }}">
                        </td>
                        <td>{{ $bike->marca }}</td>
                        <td>{{ $bike->modelo }}</td>
                        <td>{{ $bike->matricula }}</td>
                        <td style="background-color: {{ $bike->color }}">{{ $bike->color }}</td>
                        <td class="text-center">
                            <a href="{{ route('bikes.show', $bike->id) }}" class="btn btn-info btn-sm">
                                <img height="20" width="20" src="{{ asset('images/buttons/show.png') }}"
                                    alt="Ver detalles" title="Ver detalles">
                            </a>
                            @auth
                                @if (Auth::user()->can('update', $bike))
                                    <a href="{{ route('bikes.edit', $bike->id) }}" class="btn btn-warning btn-sm">
                                        <img height="20" width="20" src="{{ asset('images/buttons/update.png') }}"
                                            alt="Modificar" title="Modificar">
                                    </a>
                                @endif
                                @can('update', $bike)
                                    <a href="{{ route('bikes.delete', $bike->id) }}" class="btn btn-danger btn-sm">
                                        <img height="20" width="20" src="{{ asset('images/buttons/delete.png') }}"
                                            alt="Eliminar" title="Eliminar">
                                    </a>
                                @endcan
                            @endauth
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

@section('enlaces')
    @parent
    <a href="{{ route('admin.users') }}" class="btn btn-primary m-2">Lista de usuarios</a>
@endsection
