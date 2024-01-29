@extends('layouts.master')

@section('content')

<div id="showall">

    <h4>Gestión de almacenes</h4>

    <input type="text" id="inputSearch" placeholder="Búsqueda por producto">

    <select name="" id="filterByStorehouse" class="">
        <option value="0" class="">Todos</option>
        @foreach($storehouses as $storehouse)
        <option value="{{ $storehouse->id }}" {{ ($storehouseSelectedId == $storehouse->id) ? 'selected' : '' }}>{{ $storehouse->name }}</option>
        @endforeach
    </select>

    <select name="" id="filterByCategory" class="">
        <option value="0" class="">Todas</option>
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
            @foreach($filtered as $index)
            <tr class="">
                <td class="">{{$index->name}}</td>
                <td class="">{{$index->prefix}}</td>
                <td class="">{{$index->description}}</td>
                <td class="">{{$index->pname}}</td>
                <td class="">{{$index->pprice}}</td>
                <td class="">{{$index->pprefix}}</td>
                <td class="">{{$index->pcategory}}</td>
                <td class=""><button class="blueButton"><a href="{{ route('products.editForm', [$index->pid]) }}" class="text-white">Editar</a></button></td>
                <td class="">{{ html()->form('DELETE', '/products/' . $index->pid . '/delete')->open() }}
                    {{ html()->submit('Borrar')->class(['grayButton', 'text-white']) }}
                    {{ html()->form()->close() }}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @endif
    <div class="submitForm">
        <button class="blueButton"><a href="{{ route('main') }}" class="text-white">Menú principal</a></button>
    </div>

</div>

@endsection

<input type="hidden" value="{{ env('APP_URL') }}" id="url">

@section('js')
<script class="" src="{{ asset('js/filters.js') }}" defer></script>
<script class="" src="{{ asset('js/searchByProduct.js') }}" defer></script>
@endsection