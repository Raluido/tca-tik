@extends('layouts.master')

@section('content')

<div class="mt-5 d-md-flex flex-column align-items-center flex-grow-1 headerBottom">

    <h5 class="mt-5">Crear nueva categoría</h5>

    <div id="messages">
        @include('layouts.partials.messages')
    </div>

    <div class="formWidth">
        <form action="{{ route('categories.backOfficeStore') }}" method="post" id="sendForm" class="mt-5 shadow-lg text-center py-5">
            @csrf
            <div class="mb-5">
                <input type="text" name="prefix" id="prefixValidator" class="w-75" placeholder="identificador de categoría">
                <h5 id="prefixError"></h5>
            </div>
            <div class="mb-4">
                <input type="text" name="name" class="w-75" id="nameValidator" placeholder="Nombre">
                <h5 id="nameError"></h5>
            </div>
            <div class="mb-4">
                <textarea name="description" rows="10" class="w-75" id="descriptionValidator" placeholder="Descriptión la categoría"></textarea>
                <h5 id="descriptionError"></h5>
            </div>
            <div class="w-100 d-flex justify-content-evenly mt-5">
                <button class="btn btn-success btn-sm" id="submitBtn">Crear</button>
                <button class="btn btn-primary btn-sm"><a href="{{ route('main') }}" class="text-white">Volver</a></button>
            </div>
        </form>
    </div>
</div>

@endsection

@section('js')
<script class="" type="module" src="{{ asset('js/validatorCat.js') }}" defer></script>
@endsection