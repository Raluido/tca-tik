@extends('layouts.master')

@section('content')

<div id="showall">

    <h4>Gestión de almacenes</h4>

    <select name="" id="filterByStorehouse" class="">
        @foreach($storehouses as $storehouse)
        <option value="{{ $storehouse->id }}" {{ ($storehouseSelectedId == $storehouse->id) ? 'selected' : '' }}>{{ $storehouse->name }}</option>
        @endforeach
    </select>

    <select name="" id="filterByCategory" class="">
        @foreach($categories as $category)
        <option value="{{ $category->id }}" {{ ($categorySelectedId == $category->id) ? 'selected' : '' }}>{{ $category->name }}</option>
        @endforeach
    </select>

    <div id="messages">
        @include('layouts.partials.messages')
    </div>

    @if(!isset($storehouses) || is_null($storehouses))
    <p class="">Aún no has creado ningún almacén.</p>
    @else
    <table class="">
        <thead class="">
            <tr class="">
                <th class="">Nombre</th>
                <th class="">Prefijo</th>
                <th class="">Descripción</th>
                <th class="">Productos</th>
                <th class="">Precio</th>
                <th class="">Identificador del producto</th>
                <th class="">Categoría del producto</th>
                <th class="">Editar</th>
                <th class="">Eliminar</th>
            </tr>
        </thead>
        <tbody class="">
            <tr class="">
                <td class="">{{$storehouseSelected->name}}</td>
                <td class="">{{$storehouseSelected->prefix}}</td>
                <td class="">{{$storehouseSelected->description}}</td>
                @foreach ($storehouseSelected->products as $product)
                <td class="">{{$product->name}}</td>
                <td class="">{{$product->price}}</td>
                <td class="">{{$product->prefix}}</td>
                <td class="">{{$product->categoryProduct->name}}</td>
                <td class=""><button class="blueButton"><a href="{{ route('products.editForm', [$product->id]) }}" class="text-white">Editar</a></button></td>
                <td class="">{{ html()->form('DELETE', '/products/' . $product->id . '/delete')->open() }}
                    {{ html()->submit('Borrar')->class(['grayButton', 'text-white']) }}
                    {{ html()->form()->close() }}
                </td>
                @endforeach
            </tr>
        </tbody>
    </table>
    @endif
    <div class="submitForm">
        <button class="greenButton"><a href="{{ route('storehousesManagement.addProduct') }}" class="text-white">Añadir</a></button>
        <button class="blueButton"><a href="{{ route('main') }}" class="text-white">Menú principal</a></button>
    </div>

</div>

@endsection



@section('js')
<script class="" src="{{ asset('js/filters.js') }}" defer></script>
@endsection