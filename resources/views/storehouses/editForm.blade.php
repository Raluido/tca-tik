@extends('layouts.master')

@section('content')

<div id="crudForm">

    <h4 class="">Editar almacén.</h4>

    <div id="messages">
        @include('layouts.partials.messages')
    </div>

    <form action="{{ route('storehouses.edit', [$storehouse]) }}" method="post" class="">
        @csrf
        @method('PUT')
        <div class="inputForm">
            <input type="text" name="name" value="{{ $storehouse->name }}" placeholder="Nombre">
        </div>
        <div class="inputForm">
            <textarea name="description" id="" cols="30" rows="10" class="" placeholder="Descriptión del almacén">{{ $storehouse->description }}</textarea>
        </div>
        <div class="inputForm">
            <input name="prefix" class="" type="text" value="{{ $storehouse->prefix }}" placeholder="identificador del almacén">
        </div>
        <div class="inputForm">
            <input type="text" name="address" value="{{ $storehouse->address }}" placeholder="Dirección">
        </div>
        <div class="submitForm">
            <input type="submit" value="Editar" class="greenButton text-white"> <button class="blueButton"><a href="{{ route('main') }}" class="text-white">Menú principal</a></button>

        </div>
    </form>
</div>

@endsection

@section('js')

@endsection