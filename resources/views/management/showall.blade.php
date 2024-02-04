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
                    <option value="{{ $storehouse->id }}">{{ $storehouse->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="">
                <label for="filterByCategory" class="">Categorías</label>
                <select name="" id="filterByCategory" class="">
                    <option value="0" class="">Todas</option>
                    @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>

    <div id="messages">
        @include('layouts.partials.messages')
    </div>

    @if(is_null($productsStr) || count($productsStr) == 0)
    <p id="noItems">No hay productos en los almacenes, selecciona un almacén para añadir alguno.</p>
    @else
    <div class="">
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
    <div class="pagination">
        <ul class="">
            @foreach($pagination as $index)
            <li class=""><a href="{{ route('storehousesManagement.showall', [$index->offset]) }}" class="">{{ $index->page }}</a></li>
            @endforeach
        </ul>
    </div>
    <div class="submitForm">
        <button class="blueButton"><a href="{{ route('main') }}" class="text-white">Volver</a></button>
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