@extends('layouts.master')

@section('content')

<div class="">
    <form action="{{ route('products.edit') }}" method="post" class="">
        @csrf
        @method('PUT')
        <div class="inputForm">
            <input type="text" name="name" value="{{ $product->name }}" placeholder="Nombre">
        </div>
        <div class="inputForm">
            <select name="" id="" class="">
                @foreach($categories as $category)
                <option value="{{ $category->id }}" <?php ($product->category == $category->id) ? "'selected' = 'selected'" : "'selected' = ''" ?>>{{ $category->name }}</option>
                @endif
                @endforeach
            </select>
        </div>
        <div class="inputForm">
            <input name="price" class="" type="number" step="0.01" placeholder="Precio">
        </div>
        <div class="inputForm">
            <textarea name="description" id="" cols="30" rows="10" class="" placeholder="Descriptión del producto"></textarea>
        </div>
        <div class="inputForm">
            <textarea name="" id="" cols="30" rows="10" class="" placeholder="Observaciones"></textarea>
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