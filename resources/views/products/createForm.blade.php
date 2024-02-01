@extends('layouts.master')

@section('content')

<div id="crudForm">

    <h4 class="">Crear nuevo producto</h4>

    <div id="messages">
        @include('layouts.partials.messages')
    </div>

    <form action="{{ route('products.create') }}" method="post" id="sendForm">
        @csrf
        <div class="inputForm">
            <input type="text" name="name" id="nameValidator" placeholder="Nombre">
            <h5 id="nameError"></h5>
        </div>
        <div class="inputForm">
            <select name="product_has_category" id="" class="">
                @foreach($categories as $category)
                <option value="{{ $category->id }}" class="">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="inputForm">
            <input name="price" class="" type="number" step="0.01" id="priceValidator" placeholder="Precio">
            <h5 id="priceError"></h5>
        </div>
        <div class="inputForm">
            <input name="prefix" class="" type="text" id="prefixValidator" placeholder="identificador del producto">
            <h5 id="prefixError"></h5>
        </div>
        <div class="inputForm">
            <textarea name="description" cols="30" rows="10" class="" id="descriptionValidator" placeholder="Descriptión del producto"></textarea>
            <h5 id="descriptionError"></h5>
        </div>
        <div class="inputForm">
            <textarea name="observations" cols="30" rows="10" class="" id="observationsValidator" placeholder="Observaciones"></textarea>
            <h5 id="observationsError"></h5>
        </div>
        <div class="submitForm">
            <input type="submit" class="greenButton text-white" id="submitBtn" value="Crear">
            <button class="blueButton"><a href="{{ route('main') }}" class="text-white">Menú principal</a></button>
        </div>
    </form>

</div>

@endsection

@section('js')
<script class="" type="module" src="{{ asset('js/validator.js') }}" defer></script>
@endsection