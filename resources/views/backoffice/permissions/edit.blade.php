@extends('layouts.master')

@section('content')
<div class="mt-5 d-flex flex-column align-items-center flex-grow-1 headerBottom">
    <h2>Editar permisos</h2>
    <div class="lead">
        Editar permisos.
    </div>

    <div class="formWidth">
        <form method="POST" action="{{ route('permissions.backOfficeUpdate', $permission->id) }}">
            @method('patch')
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Nombre</label>
                <input value="{{ $permission->name }}" type="text" class="form-control" name="name" placeholder="Name" required>

                @if ($errors->has('name'))
                <span class="text-danger text-left">{{ $errors->first('name') }}</span>
                @endif
            </div>
            <div class="d-flex justify-content-center mt-5">
                <button type="submit" class="btn btn-primary">Guardar</button>
                <a href="{{ route('permissions.showBackOfficeIndex') }}" class="btn btn-default">Volver</a>
            </div>
        </form>
    </div>

</div>
@endsection