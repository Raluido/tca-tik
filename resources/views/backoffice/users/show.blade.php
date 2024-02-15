@extends('layouts.master')

@section('content')

<div class="mt-5 d-flex flex-column align-items-center flex-grow-1 headerBottomWelcome">
    <h1>Mostrar usuario</h1>
    <div class="lead">

    </div>

    <div class="formWidth">
        <div>
            Name: {{ $user->name }}
        </div>
        <div>
            Email: {{ $user->email }}
        </div>
        <div>
            Username: {{ $user->username }}
        </div>
        <div class="d-flex justify-content-center mt-5">
            <a href="{{ route('users.showBackOfficeEdit', $user->id) }}" class="btn btn-info">Editar</a>
            <a href="{{ route('users.showBackOfficeIndex') }}" class="btn btn-default">Volver</a>
        </div>
    </div>

</div>
@endsection