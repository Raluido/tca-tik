@extends('layouts.master')

@section('content')

<div class="d-flex flex-column align-items-center flex-grow-1 headerBottom">

    <h5 class="mt-5">Crear nuevo producto</h5>

    <div id="messages">
        @include('layouts.partials.messages')
    </div>

    <div class="formWidth">
        <form action="{{ route('products.create') }}" method="post" id="sendForm" class="mt-3 shadow-lg text-center py-5">
            @csrf
            <div class="mb-4">
                <input type="text" name="name" class="w-75" id="nameValidator" placeholder="Nombre">
                <h5 id="nameError"></h5>
            </div>
            <div class="mb-4">
                <select name="product_has_category" id="" class="w-75">
                    @foreach($categories as $category)
                    <option value="{{ $category->id }}" class="">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-4">
                <input name="price" class="w-75" type="number" step="0.01" id="priceValidator" placeholder="Precio">
                <h5 id="priceError"></h5>
            </div>
            <div class="mb-4">
                <input name="tax" class="w-75" type="number" step="0.01" id="priceValidator" placeholder="Impuesto">
                <h5 id="taxError"></h5>
            </div>
            <div class="mb-4">
                <input name="prefix" class="w-75" type="text" id="prefixValidator" placeholder="identificador del producto">
                <h5 id="prefixError"></h5>
            </div>
            <div class="mb-4">
                <textarea name="description" rows="10" class="w-75" id="descriptionValidator" placeholder="Descriptión del producto"></textarea>
                <h5 id="descriptionError"></h5>
            </div>
            <div class="mb-5">
                <textarea name="observations" rows="10" class="w-75" id="observationsValidator" placeholder="Observaciones"></textarea>
                <h5 id="observationsError"></h5>
            </div>
            <div class="mb-4">
                <input name="images[]" class="w-75" type="file" id="" placeholder="Imágenes">
                <h5 id=""></h5>
            </div>
            <div class="d-flex justify-content-evenly">
                <input type="submit" class="btn btn-success btn-sm" id="submitBtn" value="Crear">
                <button class="btn btn-primary btn-sm"><a href="{{ route('main') }}" class="text-white">Volver</a></button>
            </div>
        </form>
    </div>

</div>

@endsection

@section('js')
<script class="" type="module" src="{{ asset('js/validator.js') }}" defer></script>
@endsection