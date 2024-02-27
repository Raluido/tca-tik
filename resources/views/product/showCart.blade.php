@extends('layouts.master')

@section('content')

<div class="headerBottomWelcome">
    <h4 class="">Mi cesta</h4>
    <div class="">
        <div class="">
            @if(!is_string($products))
            @foreach($products as $product)
            @if(isset($product->images) && !is_null($product->images)) $image = explode(',', $product->images);
            <div class="">
                <img src="{{ Storage::disk('images')->url($image[0]) }}" alt="" class="">
            </div>
            @else
            <div class="">
                <img src="{{ Storage::disk('images')->url('default.png') }}" alt="" class="">
            </div>
            @endif
            <div class="productInfo">
                <h5 class="">{{ $product->name }}</h5>
                <h4 class="">{{ $product->price }} €</h4>
                <p class="">{{ $product->description }}</p>
            </div>
            <div class="addRemoveItems">
                <div id="removeFromCartOne" data-id="{{ $product->id }}">-</div><input type="text" data-id="{{ $product->id }}" id="cartItemAmount" value="{{ $product->quantity }}">
                <div id="addToCartOne" data-id="{{ $product->id }}">+</div>
            </div>
            @endforeach
            @else
            <div class="">
                <p class="">{{ $products }}</p>
            </div>
            @endif
        </div>
    </div>
</div>

<input type="hidden" value="{{ env('APP_URL') }}" id="url">
@endsection


@section('js')
<script class="" type="text/javascript" src="{{ asset('js/addToCart.js') }}" defer></script>
@endsection