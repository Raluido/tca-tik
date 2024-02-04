@extends('layouts.master')

@section('content')

<div class="mt-5 d-flex flex-column align-items-center">

    <h4 class="text-center mb-5">Gestión de almacenes</h4>

    <div class="w-75 mb-5 shadow-lg p-5">
        <h5 class="mb-5 text-center">Filtros</h5>
        <div class="">
            <div class="d-flex justify-content-evenly mb-4">
                <label for="filterByStorehouse" class="">Almacenes</label>
                <select name="" id="filterByStorehouse" class="w-50">
                    <option value="0" class="">Todos</option>
                    @foreach($storehouses as $storehouse)
                    <option value="{{ $storehouse->id }}" {{ ($storehouse->id == $storehouseSelectedId) ? 'selected' : '' }}>{{ $storehouse->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="d-flex justify-content-evenly">
                <label for="filterByCategory" class="">Categorias</label>
                <select name="" id="filterByCategory" class="w-50">
                    <option value="0" class="">Todas</option>
                    @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ ($category->id == $categorySelectedId) ? 'selected' : '' }}>{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="d-flex flex-column align-items-center">
            <input type="text" id="inputSearch" class="mt-5 text-center w-75" placeholder="Búsqueda por producto">
            <div class="d-none" id="searchDropdown"></div>
        </div>
    </div>

    @if(count($products) != 0 || !is_null($products))
    <div class="w-75 mb-5 shadow-lg p-5">
        <h4 class="text-center mb-5">Añadir nuevo</h4>
        <table class="table">
            <thead class="">
                <tr class="">
                    <th class="">Productos</th>
                    <th class="">Añadir</th>
                    <th class="">Acción</th>
                </tr>
            </thead>
            <tbody class="">
                <tr class="">
                    <td class=""><select name="" id="productsCounter" class="">
                            @foreach($products as $product)
                            <option value="{{ $product->id }}" {{ ($product->id == $productSelectedId) ? 'selected' : '' }}>{{ $product->name }}</option>
                            @endforeach
                        </select></td>
                    <td class="">
                        <button id="addProduct" class="greenButton text-white">Añadir</button>
                        <button id="removeProduct" class="redButton text-white">Quitar</button>
                    </td>
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
    <div class="w-75 mb-5 shadow-lg p-5">
        <h4 class="text-center mb-5">Productos en stock</h4>
        <table class="table">
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
    <div class="">
        <ul class="">
            @foreach($pagination as $index)
            <li class="d-inline-block"><a href="{{ route('storehousesManagement.showBy', [$storehouseSelectedId, $categorySelectedId, $productSelectedId, $searchProductId, $index->offset]) }}" class="">{{ $index->page }}</a></li>
            @endforeach
        </ul>
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