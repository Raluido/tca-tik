@extends('layouts.master')

@section('content')

<div class="row">
    <div class="col-md-8 row">
        @if(!is_null($product->images))
        @php $images = explode(',', $product->images); @endphp
        <div class="col-md-8 carousel">
            @for($i=1;$i<=count($images);$i++) <input type="radio" class="slides" name="slide_{{$i}}">
                @endfor
                <ul class="bigImages">
                    @foreach($images as $image)
                    <li class="imgContainer">
                        <img src="{{ Storage::disk('images')->url($image) }}" alt="" class="">
                    </li>
                    @endforeach
                </ul>
                <ul class="smImages">
                    @foreach($images as $image)
                    <li class="imgContainer">
                        <img src="{{ Storage::disk('images')->url($image) }}" alt="" class="">
                    </li>
                    @endforeach
                </ul>
        </div>
        @else
        <div class="col-md-8 imgContainer">
            <img src="{{ Storage::disk('images')->url('default.png') }}" alt="" class="">
        </div>
        @endif
        <div class="col-md-4 productInfo">
            <h4 class="">{{ $product->pname }}</h4>
            <p class="">{{ $product->pprefix }}</p>
            <p class="">{{ $product->pdescription }}</p>
        </div>
    </div>
    <div class="col-md-4">
        <h4 class="">{{ $product->pprice }}</h4>
        @if($product->totalStock != 0)
        <p class="">{{ $product->totalStock }}</p>
        @else
        <p class="text-red">No hay stock</p>
        @endif
        @if($product->totalStock != 0)
        <button id="addToCart" data-id="{{ $product->id }}">Añadir al carrito</button>
        @else
        <button class="" disabled>Añadir al carrito</button>
        @endif
    </div>
</div>

<input type="hidden" value="{{ env('APP_URL') }}" id="url">
@endsection


@section('js')
<script class="" type="text/javascript" src="{{ asset('js/addToCart.js') }}" defer></script>
@endsection