@extends('layouts.master')

@section('content')

<div id="showall">

    <h3>Gestión de almacenes</h3>

    <input type="text" id="inputSearch" placeholder="Búsqueda por producto">
    <div class="d-none" id="searchDropdown"></div>

    <div id="filters">
        <h4 class="">Filtros</h4>
        <div class="innerFilters">
            <div class="">
                <label for="filterByStorehouse" class="">Almacenes</label>
                <select name="" id="filterByStorehouse" class="">
                    <option value="0" class="">Todos</option>
                    @foreach($storehouses as $storehouse)
                    <option value="{{ $storehouse->id }}" {{ ($storehouse->id == $storehouseSelectedId) ? 'selected' : '' }}>{{ $storehouse->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="">
                <label for="filterByCategory" class="">Categorias</label>
                <select name="" id="filterByCategory" class="">
                    <option value="0" class="">Todas</option>
                    @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ ($category->id == $categorySelectedId) ? 'selected' : '' }}>{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>

    @if(count($products) != 0 || !is_null($products))
    <div id="addProductTable">
        <h3 class="">Añadir nuevo</h3>
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
                    <td class=""><select name="" id="productsCounter" class="">
                            @foreach($products as $product)
                            <option value="{{ $product->id }}" {{ ($product->id == $productSelectedId) ? 'selected' : '' }}>{{ $product->name }}</option>
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
    @endif

    <div id="messages">
        @include('layouts.partials.messages')
    </div>

    @if(count($filtered)== 0 || is_null($filtered))
    <p class="" style="margin-top:4em;">No hay productos almacenados.</p>
    @else
    <div id="stockProducts">
        <h3 class="">Productos en stock</h3>
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
                    <th class="">Total</th>
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
                    <td class="">{{$index->total}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @endif
    </div>
    <div class="submitForm">
        <button class="blueButton"><a href="{{ route('main') }}" class="text-white">Volver</a></button>
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