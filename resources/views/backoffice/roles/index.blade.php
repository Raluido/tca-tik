@extends('layouts.master')

@section('content')


<div class="mt-5 d-flex flex-column align-items-center flex-grow-1 headerBottom">
    <h1>Roles</h1>
    <div class="lead">
        Gestiona los roles
        <a href="{{ route('roles.create') }}" class="btn btn-primary btn-sm float-right">Añadir</a>
    </div>

    <div class="mt-2">
        @include('layouts.partials.messages')
    </div>

    <div class="tableWidth">
        <table class="table table-bordered">
            <tr>
                <th width="1%">No</th>
                <th>Nombre</th>
                <th width="3%" colspan="3">Acción</th>
            </tr>
            @foreach ($roles as $key => $role)
            <tr>
                <td>{{ $role->id }}</td>
                <td>{{ $role->name }}</td>
                <td>
                    <a class="btn btn-info btn-sm" href="{{ route('roles.show', $role->id) }}">Mostrar</a>
                </td>
                <td>
                    <a class="btn btn-primary btn-sm" href="{{ route('roles.edit', $role->id) }}">Editar</a>
                </td>
                <td>
                    {{ html()->form('DELETE',  route('roles.destroy', [$role->id]), ('display:inline'))->open() }}
                    {{ html()->submit('Borrar')->class('btn btn-danger btn-sm') }}
                    {{ html()->form()->close() }}
                </td>
            </tr>
            @endforeach
        </table>

    </div>
    <div class="d-flex">
        {!! $roles->links() !!}
    </div>
    <div class="mt-5">
        <a href="{{ route('main') }}" class="btn btn-default">Volver</a>
    </div>

</div>
@endsection