@extends('layouts.master')

@section('content')

<div class="">

    <h4 class="">Añadir stock a almacén</h4>

    <div class="">
        @foreach($storehouses as $storehouse)
        <div class="">
            <div class="">{{ $storehouse->name }}</div>
            <div class="productSelected">
                <select name="" class="productsCounter" data="{{ $storehouse->id }}" class="">
                    @foreach($products as $product)
                    <option value="{{ $product->id }}" class="">{{ $product->name }}</option>
                    @endforeach
                </select>
            </div>
            <button id="addProduct" class="greenButton text-white">Añadir</button>
            <button id="removeProduct" class="redButton text-white">Quitar</button>
            <div id="counter"></div>
        </div>
        @endforeach
    </div>

</div>

<input type="hidden" value="{{ env('APP_URL') }}" id="url">

@endsection

@section('js')
<script class="" type="module" src="{{ asset('js/addToStorehouse.js') }}" defer></script>
<script class="" type="module" src="{{ asset('js/productsCounter.js') }}" defer></script>
@endsection