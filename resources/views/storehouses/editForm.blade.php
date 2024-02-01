@extends('layouts.master')

@section('content')

<div id="crudForm">

    <h4 class="">Editar almacén.</h4>

    <div id="messages">
        @include('layouts.partials.messages')
    </div>

    <form action="{{ route('storehouses.edit', [$storehouse]) }}" method="post" id="sendForm">
        @csrf
        @method('PUT')
        <div class="inputForm">
            <input type="text" name="name" value="{{ $storehouse->name }}" id="nameValidator" placeholder="Nombre">
            <h5 id="nameError"></h5>
        </div>
        <div class="inputForm">
            <textarea name="description" id="descriptionValidator" cols="30" rows="10" class="" placeholder="Descriptión del almacén">{{ $storehouse->description }}</textarea>
            <h5 id="descriptionError"></h5>
        </div>
        <div class="inputForm">
            <input name="prefix" class="" type="text" value="{{ $storehouse->prefix }}" id="prefixValidator" placeholder="identificador del almacén">
            <h5 id="prefixError"></h5>
        </div>
        <div class="inputForm">
            <input type="text" name="address" value="{{ $storehouse->address }}" id="addressValidator" placeholder="Dirección">
            <h5 id="addressError"></h5>
        </div>
        <div class="submitForm">
            <button class="greenButton text-white" id="submitBtn">Editar</button>
            <button class="blueButton"><a href="{{ route('main') }}" class="text-white">Menú principal</a></button>
        </div>
    </form>
</div>

@endsection

@section('js')
<script class="" type="module" src="{{ asset('js/validatorStr.js') }}" defer></script>
@endsection