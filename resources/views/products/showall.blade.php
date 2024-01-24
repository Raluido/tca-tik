@extends('layouts.master')

@section('main')

<div class="">
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
            @foreach (@products as $product)
            <tr class="">
                <td class="">{{$product->name}}</td>
                <td class="">{{$product->category}}</td>
                <td class="">{{$product->description}}</td>
                <td class="">{{$product->price}}</td>
                <td class="">{{$product->observations}}</td>
                <td class=""></td>
                <td class="">{{$product->observations}}</td>
                <td class="">{{$product->observations}}</td>
            </tr>
        </tbody>

    </table>
</div>

@endsection