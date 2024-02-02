@extends('layouts.master')

@section('content')

<div id="crudForm">

    <h4 class="">Editar categoría</h4>

    <div id="messages">
        @include('layouts.partials.messages')
    </div>

    <form action="{{ route('categories.edit', [$category->id]) }}" method="post" id="sendForm">
        @csrf
        @method('PUT')
        <div class="inputForm">
            <input type="text" name="name" value="{{ $category->name }}" id="nameValidator" placeholder="Nombre">
            <h5 id="nameError"></h5>
        </div>
        <div class="inputForm">
            <textarea name="description" cols="30" rows="10" class="" id="descriptionValidator" placeholder="Descriptión la categoría"><?php echo $category->description ?></textarea>
            <h5 id="descriptionError"></h5>
        </div>
        <div class="inputForm">
            <input type="text" name="prefix" value="{{ $category->prefix }}" id="prefixValidator" placeholder="identificador de categoría">
            <h5 id="prefixError"></h5>
        </div>

        <div class="submitForm">
            <button class="greenButton text-white" id="submitBtn">Editar</button>
            <button class="blueButton"><a href="{{ route('main') }}" class="text-white">Volver</a></button>

        </div>
    </form>
</div>

@endsection

@section('js')
<script class="" type="module" src="{{ asset('js/validatorCat.js') }}" defer></script>
@endsection