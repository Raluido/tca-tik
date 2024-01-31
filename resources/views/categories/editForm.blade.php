@extends('layouts.master')

@section('content')

<div id="crudForm">

    <h4 class="">Editar categoría</h4>

    <div id="messages">
        @include('layouts.partials.messages')
    </div>

    <form action="{{ route('categories.edit', [$category->id]) }}" method="post" class="">
        @csrf
        @method('PUT')
        <div class="inputForm">
            <input type="text" name="name" value="{{ $category->name }}" placeholder="Nombre">
        </div>
        <div class="inputForm">
            <textarea name="description" id="" cols="30" rows="10" class="" placeholder="Descriptión la categoría"><?php echo $category->description ?></textarea>
        </div>
        <div class="inputForm">
            <input type="text" name="prefix" value="{{ $category->prefix }}" placeholder="identificador de categoría">
        </div>
        <div class="submitForm">
            <input type="submit" value="Editar" class="greenButton text-white">
            <button class="blueButton"><a href="{{ route('main') }}" class="text-white">Menú principal</a></button>

        </div>
    </form>
</div>

@endsection

@section('js')

@endsection