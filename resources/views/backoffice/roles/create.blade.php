@extends('layouts.master')

@section('content')
<div class="mt-5 d-flex flex-column align-items-center flex-grow-1 headerBottom">
    <h1>Añadir nuevo rol</h1>
    <div class="lead">
        Gestiona roles y permisos:
    </div>

    <div class="container mt-4">

        @if (count($errors) > 0)
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form method="POST" action="{{ route('roles.backOfficeStore') }}">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Nombre</label>
                <input value="{{ old('name') }}" type="text" class="form-control" name="name" placeholder="Nombre" required>
            </div>

            <label for="permissions" class="form-label">Asignar permisos</label>

            <div class="fixoverflowTable">
                <table class="table table-striped">
                    <thead>
                        <th scope="col" width="1%"><input type="checkbox" name="all_permission"></th>
                        <th scope="col" width="20%">Name</th>
                        <th scope="col" width="1%">Guard</th>
                    </thead>

                    @foreach($permissions as $permission)
                    <tr>
                        <td>
                            <input type="checkbox" name="permission[{{ $permission->name }}]" value="{{ $permission->name }}" class='permission'>
                        </td>
                        <td>{{ $permission->name }}</td>
                        <td>{{ $permission->guard_name }}</td>
                    </tr>
                    @endforeach
                </table>
            </div>
            <div class="w-100 d-flex justify-content-evenly mt-5">
                <button type="submit" class="btn btn-success btn-sm">Guardar</button>
                <button class="btn btn-primary btn-sm text-white"><a href="{{ route('roles.showBackOfficeIndex') }}" class="text-white">Volver</a></button>
            </div>
        </form>
    </div>

</div>
@endsection

@section('scripts')
<script type="text/javascript">
    $(document).ready(function() {
        $('[name="all_permission"]').on('click', function() {

            if ($(this).is(':checked')) {
                $.each($('.permission'), function() {
                    $(this).prop('checked', true);
                });
            } else {
                $.each($('.permission'), function() {
                    $(this).prop('checked', false);
                });
            }

        });
    });
</script>
@endsection