@extends('layouts.master')

@section('content')

<div class="">
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
            <div class=""><span class=""></span>{{ $product->quantity }}<span class=""></span></div>
            @endforeach
            @else
            <div class="">
                <p class="">{{ $products }}</p>
            </div>
            @endif
        </div>
    </div>
</div>

@endsection


@section('js')

@endsection