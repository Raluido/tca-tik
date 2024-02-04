@extends('layouts.master')

@section('content')

<div id="showall">

    <he class="">Tabla de producto</he>

    <div id="messages">
        @include('layouts.partials.messages')
    </div>

    <div class="">
        <table class="table">
            <thead class="">
                <tr class="">
                    <th class="">Nombre</th>
                    <th class="">Categoría</th>
                    <th class="">Descripción</th>
                    <th class="">Precio</th>
                    <th class="">Observaciones</th>
                    <th class="">Acciones</th>
                </tr>
            </thead>
            <tbody class="">
                <tr class="">
                    <td class="">{{$product->name}}</td>
                    <td class="">{{$product->category->name}}</td>
                    <td class="">{{$product->description}}</td>
                    <td class="">{{$product->price}}</td>
                    <td class="">{{$product->observations}}</td>
                    <td class=""><button class="blueButton"><a href="{{ route('products.editForm', [$product->id]) }}" class="text-white">Editar</a></button>
                        <button class="redButton text-white deleteProduct" value="{{ $product->id }}">Eliminar</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="submitForm">
        <button class="greenButton"><a href="{{ route('products.createForm') }}" class="text-white">Crear</a></button>
        <button class="blueButton"><a href="{{ route('products.showall') }}" class="text-white">Volver</a></button>
    </div>
</div>

<input type="hidden" value="{{ env('APP_URL') }}" id="url">

@endsection

@section('js')
<script class="" src="{{ asset('js/deleteConfirm.js') }}" defer></script>
@endsection