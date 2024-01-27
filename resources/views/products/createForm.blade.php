@extends('layouts.master')

@section('content')

<div id="crudForm">

    <h4 class="">Crear nuevo producto</h4>

    <div id="messages">
        @include('layouts.partials.messages')
    </div>

    <form action="{{ route('products.create') }}" method="post" class="">
        @csrf
        <div class="inputForm">
            <input type="text" name="name" class="" placeholder="Nombre">
        </div>
        <div class="inputForm">
            <select name="product_has_category" id="" class="">
                @foreach($categories as $category)
                <option value="{{ $category->id }}" class="">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="inputForm">
            <input name="price" class="" type="number" step="0.01" placeholder="Precio">
        </div>
        <div class="inputForm">
            <input name="prefix" class="" type="text" placeholder="identificador del producto">
        </div>
        <div class="inputForm">
            <textarea name="description" id="" cols="30" rows="10" class="" placeholder="Descriptión del producto"></textarea>
        </div>
        <div class="inputForm">
            <textarea name="observations" id="" cols="30" rows="10" class="" placeholder="Observaciones"></textarea>
        </div>
        <div class="submitForm">
            <input type="submit" value="Crear" class="greenButton text-white">
            <button class="blueButton"><a href="{{ route('main') }}" class="text-white">Menú principal</a></button>
        </div>
    </form>

</div>

@endsection

@section('js')
<script class="" type="module" src="{{ asset('js/addStorehouses.js') }}" defer></script>
@endsection