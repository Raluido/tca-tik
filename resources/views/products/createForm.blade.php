@extends('layouts.master')

@section('content')

<div class="">
    <form action="{{ route('products.create') }}" method="post" class="">
        @csrf
        <div class="">
            <input type="text" name="name" class="" placeholder="Nombre">
        </div>
        <div class="">
            <select name="category" id="" class="">
                @foreach($categories as $category)
                <option value="{{ $category->id }}" class="">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="">
            <input name="price" class="" type="number" step="0.01" placeholder="Precio">
        </div>
        <div class="">
            <textarea name="description" id="" cols="30" rows="10" class="" placeholder="Descriptión del producto"></textarea>
        </div>
        <div class="">
            <textarea name="" id="" cols="30" rows="10" class="" placeholder="Observaciones"></textarea>
        </div>
        <div class="">
            <input type="submit" value="Crear" class="">
        </div>
    </form>
</div>

@endsection

@section('js')

@endsection