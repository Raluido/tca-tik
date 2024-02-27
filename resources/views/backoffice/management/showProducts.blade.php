@extends('layouts.master')

@section('content')

<div class="mt-5 d-md-flex flex-column align-items-center flex-grow-1 flex-wrap headerBottom">

    <h4 class="text-center mb-5">Gestión de almacenes</h4>

    <div class="filtersWidth mb-5 shadow-lg">
        <h5 class="mb-5 text-center">Filtros</h5>
        <div id="filters"></div>
        <div class="">
            <div class="d-flex justify-content-center" id="historicContainer">
                <label for="historic" class="me-4">Historico</label>
                <input type="checkbox" id="historic" class="">
            </div>
        </div>
        <div class="d-flex flex-column align-items-center">
            <input type="text" id="inputSearch" class="d-block mt-5 text-center w-75" placeholder="Búsqueda por producto">
            <div class="d-none" id="searchDropdown"></div>
        </div>
    </div>

    <div class="" id="addNewPrd">
    </div>

    <div class="mb-5 shadow-lg p-5 fixoverflowTable">
        <h4 class="text-center">Productos en stock</h4>
        <table class="table fullfilledTable overflow-scroll mx-3"></table>
    </div>
    <div class="paginationMng w-100 d-flex align-items-center flex-column"></div>
    <div class="w-100 d-flex justify-content-evenly mt-5">
        <button class="btn btn-primary btn-sm"><a href="{{ route('main') }}" class="text-white">Volver</a></button>
    </div>
</div>

@endsection

<input type="hidden" value="{{ env('APP_URL') }}" id="url">
<input type="hidden" value="0" id="searchProductId">
<input type="hidden" value="0" id="storehouseSelected">
<input type="hidden" value="0" id="categorySelected">
<input type="hidden" value="0" id="offset">
<input type="hidden" value="false" id="historicSelected">

@section('js')
<script class="" src="{{ asset('js/showProductsBackend.js') }}" defer></script>
<script class="" src="{{ asset('js/addToStorehouse.js') }}" defer></script>
@endsection