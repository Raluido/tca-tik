@extends('layouts.master')

@section('content')

<div class="d-flex align-items-center flex-column mt-5 headerBottomLogin">

    <h5 class="loginTitle">Logueate</h5>

    <div id="messages">
        @include('layouts.partials.messages')
    </div>

    <form method="post" action="{{ route('login.perform') }}" class="mt-2 shadow-lg p-4 loginForm">
        @csrf

        <div class="mb-4 d-flex justify-content-center">
            <input type="text" name="name" class="w-75" placeholder="Usuario" require="required">
        </div>
        <div class="d-flex justify-content-center">
            <input type="password" name="password" class="w-75" placeholder="Contraseña" require="required">
        </div>
        <div class="mt-5 d-flex justify-content-around btn-sm">
            <input type="submit" value="Acceder" class="btn btn-success btn-sm">
            <button class="btn btn-primary btn-sm"><a href="{{ route('main') }}" class="text-white">Menú principal</a></button>
        </div>

        <p class="my-4 text-center"><i class="fa-solid fa-arrow-right me-2"></i><a href="{{ route('register.show') }}" class="text-secondary">Regístrate!</a></p>

    </form>

</div>


@endsection