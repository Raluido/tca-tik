@extends('layouts.master')

@section('content')

<div id="createForm">

    <h4 class="">Crear nueva producto</h4>

    <form action="{{ route('products.create') }}" method="post" class="">
        @csrf
        <div class="createInput">
            <input type="text" name="name" class="" placeholder="Nombre">
        </div>
        <div class="createInput">
            <select name="category" id="" class="">
                @foreach($categories as $category)
                <option value="{{ $category->id }}" class="">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="createInput">
            <input name="price" class="" type="number" step="0.01" placeholder="Precio">
        </div>
        <div class="createInput">
            <textarea name="description" id="" cols="30" rows="10" class="" placeholder="Descriptión del producto"></textarea>
        </div>
        <div class="createInput">
            <textarea name="" id="" cols="30" rows="10" class="" placeholder="Observaciones"></textarea>
        </div>
        <div class="createSubmitInput">
            <input type="submit" value="Crear" class="">
        </div>
    </form>

</div>

@endsection

@section('js')

@endsection