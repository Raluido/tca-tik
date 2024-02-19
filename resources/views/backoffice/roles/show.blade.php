@extends('layouts.master')

@section('content')
<div class="mt-5 d-md-flex flex-column align-items-center flex-grow-1 headerBottom">
    <h1>{{ ucfirst($role->name) }} Rol</h1>
    <div class="lead">

    </div>

    <div class="mt-4">

        <h3>Permisos asignados</h3>

        <div class="fixoverflowTable">
            <table class="table table-striped">
                <thead>
                    <th scope="col" width="20%">Nombre</th>
                    <th scope="col" width="1%">Guard</th>
                </thead>

                @foreach($rolePermissions as $permission)
                <tr>
                    <td>{{ $permission->name }}</td>
                    <td>{{ $permission->guard_name }}</td>
                </tr>
                @endforeach
            </table>
        </div>
    </div>
    <div class="w-100 d-flex justify-content-evenly mt-5">
        <a href="{{ route('roles.showBackOfficeEdit', $role->id) }}" class="btn btn-success btn-s">Editar</a>
        <a href="{{ route('roles.showBackOfficeIndex') }}" class="btn btn-primary btn-sm">Volver</a>
    </div>
</div>
@endsection