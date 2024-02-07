@extends('layouts.master')

@section('content')

<div class="mt-5 d-flex flex-column align-items-center flex-grow-1 flex-wrap headerBottom">

    <h4 class="text-center mb-5">Gestión de almacenes</h4>

    <div class="filtersWidth mb-5 shadow-lg">
        <h5 class="mb-5 text-center">Filtros</h5>
        <div class="">
            <div class="d-flex justify-content-evenly mb-4">
                <label for="filterByStorehouse" class="">Almacenes</label>
                <select name="" id="filterByStorehouse" class="w-50">
                    <option value="0" class="">Todos</option>
                    @foreach($storehouses as $storehouse)
                    <option value="{{ $storehouse->id }}">{{ $storehouse->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="d-flex justify-content-evenly">
                <label for="filterByCategory" class="">Categorias</label>
                <select name="" id="filterByCategory" class="w-50">
                    <option value="0" class="">Todas</option>
                    @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="d-flex flex-column align-items-center">
            <input type="text" id="inputSearch" class="d-block mt-5 text-center w-75" placeholder="Búsqueda por producto">
            <input type="text" id="inputSearch1" class="d-none mt-5 text-center w-75" placeholder="Búsqueda por producto">
            <div class="d-none" id="searchDropdown"></div>
        </div>
    </div>

    <div class="d-none filtersWidth mb-5 shadow-lg p-5" id="addNewPrd">
        <h4 class="text-center mb-5">Añadir nuevo</h4>
        <table class="table">
            <thead class="">
                <tr class="">
                    <th class="">Productos</th>
                    <th class="">Acción</th>
                    <th class="">Stocks</th>
                </tr>
            </thead>
            <tbody class="">
                <tr class="">
                    <td class="">
                        <select name="" id="productSelected" class="">
                            <option value="0" class=""></option>
                            @foreach($products as $product)
                            <option value="{{ $product->id }}">{{ $product->name }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td class="">
                        <button id="addProduct" class="btn btn-success btn-sm">Añadir</button>
                        <button id="removeProduct" class="btn btn-danger btn-sm">Quitar</button>
                    </td>
                    <td class="">
                        <div id="counter"></div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="mb-5 shadow-lg p-5">
        <h4 class="text-center mb-5">Productos en stock</h4>
        <table class="table fullfilledTable overflow-scroll">

        </table>
    </div>
    <div class="paginationMng d-flex flex-column align-items-center">
    </div>
    <div class="submitForm">
        <button class="btn btn-primary btn-sm"><a href="{{ route('main') }}" class="text-white">Volver</a></button>
    </div>
</div>

@endsection

<input type="hidden" value="{{ env('APP_URL') }}" id="url">
<input type="hidden" value="0" id="searchProductId">
<input type="hidden" value="0" id="storehouseSelected">
<input type="hidden" value="0" id="categorySelected">
<input type="hidden" value="0" id="offset">

@section('js')
<script class="" src="{{ asset('js/loadProducts&Search.js') }}" defer></script>
<script class="" src="{{ asset('js/loadGroupProducts&Search.js') }}" defer></script>
@endsection