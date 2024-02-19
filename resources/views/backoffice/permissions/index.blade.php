@extends('layouts.master')

@section('content')

<div class="mt-5 d-flex flex-column headerBottom">

    <h2>Permisos</h2>
    <div class="lead">
        Gestiona tus permisos aquí
        <a href="{{ route('permissions.showBackOfficeCreate') }}" class="btn btn-success btn-sm float-right">Añadir permiso</a>
    </div>

    <div class="mt-2">
        @include('layouts.partials.messages')
    </div>

    <div class="fixoverflowTable">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col" width="15%">Nombre</th>
                    <th scope="col">Guard</th>
                    <th scope="col" colspan="3" width="1%"></th>
                </tr>
            </thead>
            <tbody>
                @foreach($permissions as $permission)
                <tr>
                    <td>{{ $permission->name }}</td>
                    <td>{{ $permission->guard_name }}</td>
                    <td><a href="{{ route('permissions.showBackOfficeEdit', $permission->id) }}" class="btn btn-info btn-sm">Editar</a></td>
                    <td>
                        {{ html()->form('DELETE',  route('permissions.backOfficeDestroy', [$permission->id]), ('display:inline'))->open() }}
                        {{ html()->submit('Borrar')->class('btn btn-danger btn-sm') }}
                        {{ html()->form()->close() }}

                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="w-100 d-flex justify-content-evenly mt-5">
        <a href="{{ route('main') }}" class="btn btn-primary btn-sm">Volver</a>
    </div>

</div>
@endsection