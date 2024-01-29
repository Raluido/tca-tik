@extends('layouts.master')

@section('content')

<div class="">

    <h4 class="">Tabla de producto</h4>

    <div id="messages">
        @include('layouts.partials.messages')
    </div>

    <table class="">
        <thead class="">
            <tr class="">
                <th class="">Nombre</th>
                <th class="">Categoría</th>
                <th class="">Descripción</th>
                <th class="">Precio</th>
                <th class="">Observaciones</th>
                <th class="">Editar</th>
                <th class="">Eliminar</th>
            </tr>
        </thead>
        <tbody class="">
            <tr class="">
                <td class="">{{$product->name}}</td>
                <td class="">{{$product->categoryProduct->name}}</td>
                <td class="">{{$product->description}}</td>
                <td class="">{{$product->price}}</td>
                <td class="">{{$product->observations}}</td>                <td class=""><button class="blueButton"><a href="{{ route('products.editForm', [$product->id]) }}" class="text-white">Editar</a></button></td>
                <td class="">{{ html()->form('DELETE', '/products/' . $product->id . '/delete')->open() }}
                    {{ html()->submit('Borrar')->class(['grayButton', 'text-white']) }}
                    {{ html()->form()->close() }}
                </td>
            </tr>
        </tbody>
    </table>
    <div class="submitForm">
        <button class="greenButton"><a href="{{ route('products.createForm') }}" class="text-white">Crear</a></button>
        <button class="blueButton"><a href="{{ route('main') }}" class="text-white">Menú principal</a></button>
    </div>
</div>

@endsection