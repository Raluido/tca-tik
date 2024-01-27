@extends('layouts.master')

@section('content')

<div class="">

    <h4 class="">Añadir stock a almacén</h4>

    <div class="">
        @foreach($storehouses as $storehouse)
        <div class="">
            <div class="">{{ $storehouse->name }}</div>
            <div class="test">
                <select name="" id="" class="">
                    @foreach($products as $product)
                    <option value="{{ $product->id }}" class="">{{ $product->name }}</option>
                    @endforeach
                </select>
            </div>
            <button id="addProduct" data="{{ $storehouse->id }}" class="greenButton text-white">Añadir productos</button>
            <div id="productCounter">0</div>
        </div>
        @endforeach
    </div>

</div>

@endsection

@section('js')
<script class="" type="module" src="{{ asset('js/addToStorehouse.js') }}" defer></script>
@endsection