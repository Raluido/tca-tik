@extends('layouts.master')

@section('content')
<div class="mt-5 d-flex flex-column align-items-center flex-grow-1 headerBottom">
    <h1>Añadir nuevo usuario</h1>
    <div class="lead">
        Añadir usuario y asignar roles.
    </div>

    <div class="formWidth">
        <form method="POST" action="">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Nombre</label>
                <input value="{{ old('name') }}" type="text" class="form-control" name="name" placeholder="Nombre" required>

                @if ($errors->has('name'))
                <span class="text-danger text-left">{{ $errors->first('name') }}</span>
                @endif
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input value="{{ old('email') }}" type="email" class="form-control" name="email" placeholder="Email" required>
                @if ($errors->has('email'))
                <span class="text-danger text-left">{{ $errors->first('email') }}</span>
                @endif
            </div>
            <div class="mb-3">
                <label for="username" class="form-label">Usuario</label>
                <input value="{{ old('username') }}" type="text" class="form-control" name="username" placeholder="Usuario" required>
                @if ($errors->has('username'))
                <span class="text-danger text-left">{{ $errors->first('username') }}</span>
                @endif
            </div>
            <div class="d-flex justify-content-center mt-5">
                <button type="submit" class="btn btn-primary">Crear</button>
                <a href="{{ route('users.showBackOfficeIndex') }}" class="btn btn-default">Volver</a>
            </div>
        </form>
    </div>

</div>
@endsection