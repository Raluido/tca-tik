@extends('layouts.master')

@section('content')

<div class="">
    @if(!isset($products) || $products === null)
    <p class="">Aún no has creado ningún producto.</p>
    @else
    <table class="">
        <thead class="">
            <tr class="">
                <th class="">Nombre</th>
                <th class="">Categoría</th>
                <th class="">Descripción</th>
                <th class="">Precio</th>
                <th class="">Observaciones</th>
                <th class="">Añadir</th>
                <th class="">Editar</th>
                <th class="">Eliminar</th>
            </tr>
        </thead>
        <tbody class="">
            @foreach ($products as $product)
            <tr class="">
                <td class="">{{$product->name}}</td>
                <td class="">{{$product->category}}</td>
                <td class="">{{$product->description}}</td>
                <td class="">{{$product->price}}</td>
                <td class="">{{$product->observations}}</td>
                <td class=""><a href="{{ route('products.createForm') }}" class="">Crear</a></td>
                <td class=""><a href="{{ route('products.editForm') }}" class="">Editar</a></td>
                {{ html()->form('DELETE', '/products/delete/' . $product->id) }}
                {{ html()->submit('Borrar')->class([]) }}
                {{ html()->form()->close() }}
            </tr>
            @endforeach
        </tbody>
    </table>
    @endif
</div>

@endsection