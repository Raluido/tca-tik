@extends('layouts.master')

@section('content')

<div class="mt-5 d-flex flex-column align-items-center flex-grow-1 headerBottom">

    <h4 class="text-center mb-5">Tabla de productos</h4>

    <div id="messages">
        @include('layouts.partials.messages')
    </div>

    @if(is_null($products) || count($products) == 0)
    <p id="noItems">Aún no has creado ningún producto.</p>
    @else
    <div class="tableWidth">
        <table class="table">
            <thead class="">
                <tr class="">
                    <th class="">Nombre</th>
                    <th class="">Categoría</th>
                    <th class="">Descripción</th>
                    <th class="">Precio</th>
                    <th class="">Observaciones</th>
                    <th class=""></th>
                </tr>
            </thead>
            <tbody class="">
                @foreach ($products as $product)
                <tr class="">
                    <td class="">{{$product->name}}</td>
                    <td class="">{{$product->category->name}}</td>
                    <td class="">{{$product->description}}</td>
                    <td class="">{{$product->price}}</td>
                    <td class="">{{$product->observations}}</td>
                    <td class=""><button class="btn btn-success btn-sm"><a href="{{ route('products.showBackOfficeOne', [$product->id]) }}" class="text-white">Mostrar</a></button>
                        <button class="btn btn-primary btn-sm"><a href="{{ route('products.showBackOfficeEdit', [$product->id]) }}" class="text-white">Editar</a></button>
                        <button class="btn btn-danger btn-sm text-white deleteProduct" value="{{ $product->id }}">Eliminar</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{ $products->links() }}
    </div>
    @endif


    <div class="w-50 d-flex justify-content-evenly mt-5">
        <button class="btn btn-success btn-sm"><a href="{{ route('products.showBackOfficeCreate') }}" class="text-white">Crear</a></button>
        <button class="btn btn-primary btn-sm"><a href="{{ route('main') }}" class="text-white">Volver</a></button>
    </div>
</div>

<input type="hidden" value="{{ env('APP_URL') }}" id="url">

@endsection

@section('js')
<script class="" src="{{ asset('js/deleteConfirm.js') }}" defer></script>
@endsection