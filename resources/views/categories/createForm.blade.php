@extends('layouts.master')

@section('content')

<div id="createForm">

    <h4 class="">Crear nueva categoría</h4>

    <div id="messages">
        @include('layouts.partials.messages')
    </div>

    <form action="{{ route('categories.create') }}" method="post" class="">
        @csrf
        <div class="createInput">
            <input type="text" name="name" class="" placeholder="Nombre">
        </div>
        <div class="createInput">
            <textarea name="description" id="" cols="30" rows="10" class="" placeholder="Descriptión la categoría"></textarea>
        </div>
        <div class="createInput">
            <input type="text" name="prefix" placeholder="identificador de categoría">
        </div>
        <div class="createSubmitInput">
            <input type="submit" value="Crear" class="">
            <a href="{{ route('main') }}" class="">Volver</a>
        </div>
    </form>
</div>

@endsection

@section('js')

@endsection