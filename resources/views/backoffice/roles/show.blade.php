@extends('layouts.master')

@section('content')
<div class="mt-5 d-flex flex-column align-items-center flex-grow-1 headerBottom">
    <h1>{{ ucfirst($role->name) }} Rol</h1>
    <div class="lead">

    </div>

    <div class="container mt-4">

        <h3>Permisos asignados</h3>

        <div class="tableWidth">
            <table class="table table-striped">
                <thead>
                    <th scope="col" width="20%">Name</th>
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

</div>
<div class="mt-4">
    <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-info">Edit</a>
    <a href="{{ route('roles.index') }}" class="btn btn-default">Back</a>
</div>
@endsection