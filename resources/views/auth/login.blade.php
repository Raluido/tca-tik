@extends('layouts.master')

@section('content')

<div id="messages">
    @include('layouts.partials.messages')
</div>

<div id="loginForm">

    <form method="post" action="{{ route('login.perform') }}">
        @csrf

        <div class="loginInputs">
            <input type="text" name="name" placeholder="Usuario" require="required">
        </div>
        <div class="loginInputs">
            <input type="text" name="password" placeholder="Contraseña" require="required">
        </div>
        <div class="loginSubmit">
            <input type="submit" class="" value="Acceder">
        </div>

    </form>

</div>

@endsection