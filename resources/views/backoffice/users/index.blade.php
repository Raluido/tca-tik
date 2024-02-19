@extends('layouts.master')

@section('content')

<div class="mt-5 d-flex flex-column headerBottom">
    <h1>Users</h1>
    <div class="lead">
        Gestión de usuarios
        <a href="{{ route('users.showBackOfficeCreate') }}" class="btn btn-primary btn-sm float-right">Añadir nuevo usuario</a>
    </div>

    <div class="mt-2">
        @include('layouts.partials.messages')
    </div>

    <div class="fixoverflowTable">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col" width="1%">#</th>
                    <th scope="col" width="15%">Nombre</th>
                    <th scope="col">Email</th>
                    <th scope="col" width="10%">Usuario</th>
                    <th scope="col" width="10%">Roles</th>
                    <th scope="col" width="1%" colspan="3"></th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr>
                    <th scope="row">{{ $user->id }}</th>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->username }}</td>
                    <td>
                        @foreach($user->roles as $role)
                        <span class="badge bg-primary">{{ $role->name }}</span>
                        @endforeach
                    </td>
                    <td><a href="{{ route('users.showBackOfficeOne', $user->id) }}" class="btn btn-warning btn-sm">Mostrar</a></td>
                    <td><a href="{{ route('users.showBackOfficeEdit', $user->id) }}" class="btn btn-info btn-sm">Editar</a></td>
                    <td>
                        {{ html()->form('DELETE',  route('users.backOfficeDestroy', [$user->id]), ('display:inline'))->open() }}
                        {{ html()->submit('Borrar')->class('btn btn-danger btn-sm')  }}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="d-flex">
        {!! $users->links() !!}
    </div>

    <div class="w-100 d-flex justify-content-evenly mt-5">
        <a href="{{ route('main') }}" class="btn btn-primary btn-sm">Volver</a>
    </div>

</div>
@endsection