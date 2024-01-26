@extends('layouts.master')

@section('content')

<div id="crudForm">

    <h4 class="">Crear nueva categoría</h4>

    <div id="messages">
        @include('layouts.partials.messages')
    </div>

    <form action="{{ route('categories.create') }}" method="post" class="">
        @csrf
        <div class="inputForm">
            <input type="text" name="name" class="" placeholder="Nombre">
        </div>
        <div class="inputForm">
            <textarea name="description" id="" cols="30" rows="10" class="" placeholder="Descriptión la categoría"></textarea>
        </div>
        <div class="inputForm">
            <input type="text" name="prefix" placeholder="identificador de categoría">
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