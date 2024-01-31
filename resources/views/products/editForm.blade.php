@extends('layouts.master')

@section('content')

<div id="crudForm">

    <h4 class="">Modificar producto</h4>

    <div id="messages">
        @include('layouts.partials.messages')
    </div>

    <form action="{{ route('products.edit', [$product->id]) }}" method="post" class="">
        @csrf
        @method('PUT')
        <div class="inputForm">
            <input type="text" name="name" value="{{ $product->name }}" placeholder="Nombre">
        </div>
        <div class="inputForm">
            <select name="product_has_category" id="" class="">
                @foreach($categories as $category)
                <option value="{{ $category->id }}" <?php ($product->category == $category->id) ? "'selected' = 'selected'" : "'selected' = ''" ?>>{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="inputForm">
            <input name="price" class="" type="number" value="{{ $product->price }}" step="0.01" placeholder="Precio">
        </div>
        <div class="inputForm">
            <input name="prefix" class="" type="text" value="{{ $product->prefix }}" id="prefixValidator" placeholder="identificador del producto">
            <h5 id="prefixError"></h5>
        </div>
        <div class="inputForm">
            <textarea name="description" id="" cols="30" rows="10" placeholder="Descriptión del producto">{{ $product->description }}</textarea>
        </div>
        <div class="inputForm">
            <textarea name="" id="" cols="30" rows="10" placeholder="Observaciones">{{ $product->observations }}</textarea>
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