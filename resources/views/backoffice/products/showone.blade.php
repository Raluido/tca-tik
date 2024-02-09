@extends('layouts.master')

@section('content')

<div class="mt-5 d-flex flex-column align-items-center headerBottom">

    <h4 class="text-center mb-5">Tabla de producto</h4>

    <div id="messages">
        @include('layouts.partials.messages')
    </div>

    <div class="tableWidth">
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
                    <td class=""><button class="btn btn-primary btn-sm"><a href="{{ route('products.editForm', [$product->id]) }}" class="text-white">Editar</a></button>
                        <button class="btn btn-danger btn-sm text-white deleteProduct" value="{{ $product->id }}">Eliminar</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="w-50 d-flex justify-content-evenly mt-5">
        <button class="btn btn-success btn-sm"><a href="{{ route('products.createForm') }}" class="text-white">Crear</a></button>
        <button class="btn btn-primary btn-sm"><a href="{{ route('products.showall') }}" class="text-white">Volver</a></button>
    </div>
</div>

<input type="hidden" value="{{ env('APP_URL') }}" id="url">

@endsection

@section('js')
<script class="" src="{{ asset('js/deleteConfirm.js') }}" defer></script>
@endsection