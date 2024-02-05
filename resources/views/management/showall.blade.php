@extends('layouts.master')

@section('content')

<div class="mt-5 d-flex flex-column align-items-center flex-grow-1 headerBottom">

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
                <label for="filterByCategory" class="">Categorías</label>
                <select name="" id="filterByCategory" class="w-50">
                    <option value="0" class="">Todas</option>
                    @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="d-flex flex-column align-items-center">
                <input type="text" id="inputSearch" class="mt-5 text-center w-75" placeholder="Búsqueda por producto">
                <div class="d-none" id="searchDropdown"></div>
            </div>
        </div>
    </div>

    <div id="messages">
        @include('layouts.partials.messages')
    </div>

    @if(is_null($productsStr) || count($productsStr) == 0)
    <p id="noItems">No hay productos en los almacenes, selecciona un almacén para añadir alguno.</p>
    @else
    <div class="tableWidth">
        <table class="table">
            <thead class="">
                <tr class="">
                    <th class="">Productos</th>
                    <th class="">Precio</th>
                    <th class="">Identificador del producto</th>
                    <th class="">Categoría del producto</th>
                    <th class="">Stocks</th>
                </tr>
            </thead>
            <tbody class="">
                @foreach($productsStr as $index)
                <tr class="">
                    <td class="">{{$index->pname}}</td>
                    <td class="">{{$index->pprice}}</td>
                    <td class="">{{$index->pprefix}}</td>
                    <td class="">{{$index->pcategory}}</td>
                    <td class="">{{$index->total}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif
    <div class="paginationMng">
        <p class="">Showing <span class="">{{ $offset + 1 }}</span> of <span class="">{{ $totalPrd }}</span> results</p>
        <ul class="text-center">
            @if($offset > 0)
            <li class="d-inline-block"><a href="{{ route('storehousesManagement.showall', [$offset - 10]) }}" class=""><</a></li>
            @endif
            @foreach($pagination as $index)
            <li class="d-inline-block" style="border-right:1px solid gray;"><a href="{{ route('storehousesManagement.showall', [$index->offset]) }}" class="">{{ $index->page }}</a></li>
            @endforeach
            @if($offset + 10 < $totalPrd)
            <li class="d-inline-block"><a href="{{ route('storehousesManagement.showall', [$offset + 10]) }}" class="">></a></li>
            @endif
        </ul>
    </div>
    <div class="submitForm">
        <button class="btn btn-primary btn-sm"><a href="{{ route('main') }}" class="text-white">Volver</a></button>
    </div>


</div>

<input type="hidden" value="{{ env('APP_URL') }}" id="url">
<input type="hidden" value="0" id="productsCounter">

@endsection

@section('js')
<script class="" src="{{ asset('js/filters.js') }}" defer></script>
<script class="" src="{{ asset('js/addToStorehouse.js') }}" defer></script>
<script class="" src="{{ asset('js/searchByProduct.js') }}" defer></script>
@endsection