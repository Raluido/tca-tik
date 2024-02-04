@extends('layouts.master')

@section('content')

<div id="crudForm">

    <h4 class="loginTitle">Logueate</h4>

    <div id="messages">
        @include('layouts.partials.messages')
    </div>

    <form method="post" action="{{ route('login.perform') }}">
        @csrf

        <div class="inputForm">
            <input type="text" name="name" placeholder="Usuario" require="required">
        </div>
        <div class="inputForm">
            <input type="text" name="password" placeholder="Contraseña" require="required">
        </div>
        <div class="submitForm">
            <input type="submit" value="Acceder" class="greenButton text-white">
            <button class="blueButton"><a href="{{ route('main') }}" class="text-white">Menú principal</a></button>
        </div>

    </form>

</div>

@endsection