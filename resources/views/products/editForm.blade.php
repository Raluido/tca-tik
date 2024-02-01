@extends('layouts.master')

@section('content')

<div id="crudForm">

    <h4 class="">Modificar producto</h4>

    <div id="messages">
        @include('layouts.partials.messages')
    </div>

    <form action="{{ route('products.edit', [$product->id]) }}" method="post" id="sendForm">
        @csrf
        @method('PUT')
        <div class="inputForm">
            <input type="text" name="name" id="nameValidator" value="{{ $product->name }}" placeholder="Nombre">
            <h5 id="nameError"></h5>
        </div>
        <div class="inputForm">
            <select name="product_has_category" id="" class="">
                @foreach($categories as $category)
                <option value="{{ $category->id }}" <?php ($product->category->id == $category->id) ? "'selected' = 'selected'" : "'selected' = ''" ?>>{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="inputForm">
            <input name="price" class="" type="number" id="priceValidator" value="{{ $product->price }}" step="0.01" placeholder="Precio">
            <h5 id="priceError"></h5>
        </div>
        <div class="inputForm">
            <input name="prefix" class="" type="text" value="{{ $product->prefix }}" id="prefixValidator" placeholder="identificador del producto">
            <h5 id="prefixError"></h5>
        </div>
        <div class="inputForm">
            <textarea name="description" cols="30" rows="10" id="descriptionValidator" placeholder="Descriptión del producto">{{ $product->description }}</textarea>
            <h5 id="descriptionError"></h5>
        </div>
        <div class="inputForm">
            <textarea name="" cols="30" rows="10" id="observationsValidator" placeholder="Observaciones">{{ $product->observations }}</textarea>
            <h5 id="observationsError"></h5>
        </div>
        <div class="submitForm">
        <button class="greenButton text-white" id="submitBtn">Editar</button>
            <button class="blueButton"><a href="{{ route('main') }}" class="text-white">Menú principal</a></button>
        </div>
    </form>
</div>

@endsection

@section('js')
<script class="" type="module" src="{{ asset('js/validator.js') }}" defer></script>
@endsection