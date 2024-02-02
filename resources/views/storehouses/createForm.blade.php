@extends('layouts.master')

@section('content')

<div id="crudForm">

    <h4 class="">Crear nuevo almacén</h4>

    <div id="messages">
        @include('layouts.partials.messages')
    </div>

    <form action="{{ route('storehouses.create') }}" method="post" id="sendForm">
        @csrf
        <div class="inputForm">
            <input type="text" name="name" id="nameValidator" class="" placeholder="Nombre">
            <h5 id="nameError"></h5>
        </div>
        <div class="inputForm">
            <textarea name="description" id="descriptionValidator" cols="30" rows="10" class="" placeholder="Descriptión del almacén"></textarea>
            <h5 id="descriptionError"></h5>
        </div>
        <div class="inputForm">
            <input type="text" name="address" id="addressValidator" class="" placeholder="Dirección">
            <h5 id="addressError"></h5>
        </div>
        <div class="inputForm">
            <input type="text" name="prefix" class="" id="prefixValidator" placeholder="identificador del almacén">
            <h5 id="prefixError"></h5>
        </div>
        <div class="submitForm">
            <button class="greenButton text-white" id="submitBtn">Crear</button>
            <button class="blueButton"><a href="{{ route('main') }}" class="text-white">Volver</a></button>
        </div>
    </form>
</div>

@endsection

@section('js')
<script class="" type="module" src="{{ asset('js/validatorStr.js') }}" defer></script>
@endsection