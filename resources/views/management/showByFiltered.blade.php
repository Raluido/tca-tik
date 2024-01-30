@extends('layouts.master')

@section('content')

<div id="showall">

    <h4>Gestión de almacenes</h4>

    <input type="text" id="inputSearch" placeholder="Búsqueda por producto">

    <div class="filters">
        <h5 class="">Filtros</h5>
        <select name="" id="filterByStorehouse" class="">
            <option value="0" class="">Todos</option>
            @foreach($storehouses as $storehouse)
            <option value="{{ $storehouse->id }}" {{ ($storehouse->id == $storehouseSelectedId) ? 'selected' : '' }}>{{ $storehouse->name }}</option>
            @endforeach
        </select>
        <select name="" id="filterByCategory" class="">
            <option value="0" class="">Todas</option>
            @foreach($categories as $category)
            <option value="{{ $category->id }}" {{ ($category->id == $categorySelectedId) ? 'selected' : '' }}>{{ $category->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="">
        <h5 class="">Añadir nuevo</h5>
        <table class="">
            <thead class="">
                <tr class="">
                    <th class="">Productos</th>
                    <th class="">Añadir</th>
                    <th class="">Quitar</th>
                    <th class="">Stock</th>
                </tr>
            </thead>
            <tbody class="">
                <tr class="">
                    <td class=""><select name="" class="productsCounter" data="{{ $storehouse->id }}" class="">
                            @foreach($products as $product)
                            <option value="{{ $product->id }}" class="">{{ $product->name }}</option>
                            @endforeach
                        </select></td>
                    <td class=""><button id="addProduct" class="greenButton text-white">Añadir</button></td>
                    <td class=""><button id="removeProduct" class="redButton text-white">Quitar</button></td>
                    <td class="">
                        <div id="counter"></div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <div id="messages">
        @include('layouts.partials.messages')
    </div>

    @if(!isset($storehouses) || is_null($storehouses))
    <p class="">Aún no has creado ningún almacén.</p>
    @else
    <h5 class="">Productos en stock</h5>
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
                    {{ html()->submit('Quitar')->class(['redButton', 'text-white']) }}
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
<script class="" type="module" src="{{ asset('js/productsCounter.js') }}" defer></script>
<script class="" type="module" src="{{ asset('js/addToStorehouse.js') }}" defer></script>
@endsection