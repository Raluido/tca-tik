@extends('layouts.master')

@section('content')

<div class="d-flex flex-column align-items-center flex-grow-1 headerBottom">

    <h4 class="mt-5">Editar almacén</h4>

    <div id="messages">
        @include('layouts.partials.messages')
    </div>

    <div class="formWidth">
        <form action="{{ route('storehouses.backOfficeUpdate', [$storehouse]) }}" method="post" id="sendForm" class="mt-5 shadow-lg text-center py-5">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <input type="text" name="name" value="{{ $storehouse->name }}" class="w-75" id="nameValidator" placeholder="Nombre">
                <h5 id="nameError"></h5>
            </div>
            <div class="mb-4">
                <textarea name="description" id="descriptionValidator" rows="10" class="w-75" placeholder="Descriptión del almacén">{{ $storehouse->description }}</textarea>
                <h5 id="descriptionError"></h5>
            </div>
            <div class="mb-4">
                <input name="prefix" class="w-75" type="text" value="{{ $storehouse->prefix }}" id="prefixValidator" placeholder="identificador del almacén">
                <h5 id="prefixError"></h5>
            </div>
            <div class="mb-5">
                <input type="text" name="address" class="w-75" value="{{ $storehouse->address }}" id="addressValidator" placeholder="Dirección">
                <h5 id="addressError"></h5>
            </div>
            <div class="d-flex justify-content-evenly">
                <button class="btn btn-success btn-sm" id="submitBtn">Editar</button>
                <button class="btn btn-primary btn-sm"><a href="{{ route('storehouses.showBackOfficeAll') }}" class="text-white">Volver</a></button>
            </div>
        </form>
    </div>
</div>

@endsection

@section('js')
<script class="" type="module" src="{{ asset('js/validatorStr.js') }}" defer></script>
@endsection