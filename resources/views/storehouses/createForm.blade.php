@extends('layouts.master')

@section('content')

<div id="crudForm">

    <h4 class="">Crear nuevo almacén</h4>

    <div id="messages">
        @include('layouts.partials.messages')
    </div>

    <form action="{{ route('storehouses.create') }}" method="post" class="">
        @csrf
        <div class="inputForm">
            <input type="text" name="name" class="" placeholder="Nombre">
        </div>
        <div class="inputForm">
            <textarea name="description" id="" cols="30" rows="10" class="" placeholder="Descriptión del almacén"></textarea>
        </div>
        <div class="inputForm">
            <input type="text" name="address" class="" placeholder="Dirección">
        </div>
        <div class="inputForm">
            <input type="text" name="prefix" class="" placeholder="identificador del almacén">
        </div>
        <div class="submitForm">
            <input type="submit" value="Crear" class="greenButton text-white">
            <button class="blueButton"><a href="{{ route('main') }}" class="text-white">Menú principal</a></button>
        </div>
    </form>
</div>

@endsection

@section('js')

@endsection