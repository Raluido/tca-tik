@extends('layouts.master')

@section('content')

<div class="d-flex flex-column align-items-center">

    <h5 class="mt-5">Crear nuevo almacén</h5>

    <div id="messages">
        @include('layouts.partials.messages')
    </div>

    <form action="{{ route('storehouses.create') }}" method="post" id="sendForm" class="w-75 mt-5 shadow-lg text-center py-5">
        @csrf
        <div class="mb-4">
            <input type="text" name="name" id="nameValidator" class="w-75" placeholder="Nombre">
            <h5 id="nameError"></h5>
        </div>
        <div class="mb-4">
            <textarea name="description" id="descriptionValidator" rows="10" class="w-75" placeholder="Descriptión del almacén"></textarea>
            <h5 id="descriptionError"></h5>
        </div>
        <div class="mb-4">
            <input type="text" name="address" id="addressValidator" class="w-75" placeholder="Dirección">
            <h5 id="addressError"></h5>
        </div>
        <div class="mb-5">
            <input type="text" name="prefix" class="w-75" id="prefixValidator" placeholder="identificador del almacén">
            <h5 id="prefixError"></h5>
        </div>
        <div class="d-flex justify-content-evenly">
            <button class="greenButton text-white" id="submitBtn">Crear</button>
            <button class="blueButton"><a href="{{ route('main') }}" class="text-white">Volver</a></button>
        </div>
    </form>
</div>

@endsection

@section('js')
<script class="" type="module" src="{{ asset('js/validatorStr.js') }}" defer></script>
@endsection