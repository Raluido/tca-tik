@extends('layouts.master')

@section('content')

<div class="d-flex flex-column align-items-center flex-grow-1 headerBottom">

    <h5 class="mt-5">Modificar producto</h5>

    <div id="messages">
        @include('layouts.partials.messages')
    </div>

    <div class="formWidth">
        <form action="{{ route('products.backOfficeupdate', [$product->id]) }}" method="post" id="sendForm" class="mt-5 shadow-lg text-center py-5">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <input type="text" name="name" id="nameValidator" class="w-75" value="{{ $product->name }}" placeholder="Nombre">
                <h5 id="nameError"></h5>
            </div>
            <div class="mb-4">
                <select name="product_has_category" id="" class="w-75">
                    @foreach($categories as $category)
                    <option value="{{ $category->id }}" <?php ($product->category->id == $category->id) ? "'selected' = 'selected'" : "'selected' = ''" ?>>{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-4">
                <input name="price" type="number" class="w-75" id="priceValidator" value="{{ $product->price }}" step="0.01" placeholder="Precio">
                <h5 id="priceError"></h5>
            </div>
            <div class="mb-4">
                <input name="prefix" type="text" class="w-75" value="{{ $product->prefix }}" id="prefixValidator" placeholder="identificador del producto">
                <h5 id="prefixError"></h5>
            </div>
            <div class="mb-4">
                <textarea name="description" rows="10" class="w-75" id="descriptionValidator" placeholder="Descriptión del producto">{{ $product->description }}</textarea>
                <h5 id="descriptionError"></h5>
            </div>
            <div class="mb-5">
                <textarea name="" rows="10" class="w-75" id="observationsValidator" placeholder="Observaciones">{{ $product->observations }}</textarea>
                <h5 id="observationsError"></h5>
            </div>
            <div class="mb-4">
                <input name="images[]" class="w-75" type="file" id="images" placeholder="Imágenes" multiple>
                <h5 id="imagesError"></h5>
                <div class="thumbnails">
                    @foreach($product->images as $thumb)
                    <div class="thumbnail">
                        <div class="thumbnailImg">
                            <img src="{{ Storage::disk('images')->url($thumb->filename) }}" alt="" class="">
                        </div>
                        <div class="thumbnailDelete text-white" data-id="{{ $thumb->id }}">
                            <p class="" style="position:relative; bottom:7px">x</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="d-flex justify-content-evenly">
                <button class="btn btn-success btn-sm text-white" id="submitBtn">Editar</button>
                <button class="btn btn-primary btn-sm"><a href="{{ route('products.showBackOfficeAll') }}" class="text-white">Volver</a></button>
            </div>
        </form>
    </div>
</div>

<input type="hidden" value="{{ env('APP_URL') }}" id="url">

@endsection

@section('js')
<script class="" type="module" src="{{ asset('js/validator.js') }}" defer></script>
<script class="" type="module" src="{{ asset('js/deleteImg.js') }}" defer></script>
@endsection