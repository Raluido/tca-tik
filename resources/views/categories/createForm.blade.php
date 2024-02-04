@extends('layouts.master')

@section('content')

<div class="d-flex flex-column align-items-center">

<h5 class="mt-5">Crear nueva categoría</h5>

    <div id="messages">
        @include('layouts.partials.messages')
    </div>

    <form action="{{ route('categories.create') }}" method="post" id="sendForm" class="w-75 mt-5 shadow-lg text-center py-5">
        @csrf
        <div class="mb-4">
            <input type="text" name="name" class="w-75" id="nameValidator" placeholder="Nombre">
            <h5 id="nameError"></h5>
        </div>
        <div class="mb-4">
            <textarea name="description" rows="10" class="w-75" id="descriptionValidator" placeholder="Descriptión la categoría"></textarea>
            <h5 id="descriptionError"></h5>
        </div>
        <div class="mb-5">
            <input type="text" name="prefix" id="prefixValidator" class="w-75" placeholder="identificador de categoría">
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
<script class="" type="module" src="{{ asset('js/validatorCat.js') }}" defer></script>
@endsection