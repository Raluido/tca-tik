@extends('layouts.master')

@section('content')

<div id="showall">

    <h3 class="">Tabla de productos</h3>

    <div id="messages">
        @include('layouts.partials.messages')
    </div>

    @if(is_null($products) || count($products) == 0)
    <p id="noItems">Aún no has creado ningún producto.</p>
    @else
    <div class="">
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
                    <td class=""><button class="greenButton"><a href="{{ route('products.showone', [$product->id]) }}" class="text-white">Mostrar</a></button>
                        <button class="blueButton"><a href="{{ route('products.editForm', [$product->id]) }}" class="text-white">Editar</a></button>
                        <button class="redButton text-white deleteProduct" value="{{ $product->id }}">Eliminar</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif

    {{ $products->links() }}

    <div class="submitForm">
        <button class="greenButton"><a href="{{ route('products.createForm') }}" class="text-white">Crear</a></button>
        <button class="blueButton"><a href="{{ route('main') }}" class="text-white">Volver</a></button>
    </div>
</div>

<input type="hidden" value="{{ env('APP_URL') }}" id="url">

@endsection

@section('js')
<script class="" src="{{ asset('js/deleteConfirm.js') }}" defer></script>
@endsection