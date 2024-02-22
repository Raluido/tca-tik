@extends('layouts.master')

@section('content')

@guest

<div class="headerBottomWelcome">
    <div class="filters mt-5 ps-5">
        <select name="" id="filterByCat" class="">
            <option value="0" class="">Categorías</option>
            @foreach($categories as $category)
            <option value="{{ $category->id }}" class="">{{ $category->name }}</option>
            @endforeach
        </select>
        <input type="text" value="" id="searchFilter">
    </div>

    <div class="banner mt-5">
        <h5 class="text-center">
            Ofertas destacadas
        </h5>
    </div>
    <div class="cardsContainer"></div>

</div>

@endguest


@role('admin')

<div class="d-flex align-items-center flex-column headerBottom">

    <h6 class="text-center mt-5">Bienvenido al panel de administrador</h6>

    <div id="messages">
        @include('layouts.partials.messages')
    </div>

    <div class="controlPanelElements">
        <details class="">
            <summary class="">Productos</summary>
            <a href="{{ route('products.showBackOfficeCreate') }}" class="text-secondary">
                <p class="text-end me-5">Crear nuevo</p>
            </a>
            <a href="{{ route('products.showBackOfficeAll') }}" class="text-secondary">
                <p class="text-end me-5">Mostrar todos</p>
            </a>
        </details>
        <details class="">
            <summary class="">Categorias</summary>
            <a href="{{ route('categories.showBackOfficeCreate') }}" class="text-secondary">
                <p class="text-end me-5">Crear nueva</p>
            </a>
            <a href="{{ route('categories.showBackOfficeAll') }}" class="text-secondary">
                <p class="text-end me-5">Mostrar todas</p>
            </a>
        </details>
        <details class="">
            <summary class="">Almacenes</summary>
            <a href="{{ route('storehouses.showBackOfficeCreate') }}" class="text-secondary">
                <p class="text-end me-5">Crear nuevo</p>
            </a>
            <a href="{{ route('storehouses.showBackOfficeAll') }}" class="text-secondary">
                <p class="text-end me-5">Mostrar todos</p>
            </a>
        </details>
        <details class="">
            <summary class="">Gestionar almacenes</summary>
            <a href="{{ route('storehousesManagement.showBackOfficeAll') }}" class="text-secondary">
                <p class="text-end me-5">Gestionar<br> almacenes</p>
            </a>
        </details>

        <hr>

        <details class="">
            <summary class="">Roles</summary>
            <a href="{{ route('roles.showBackOfficeIndex') }}" class="text-secondary">
                <p class="text-end me-5">Gestionar roles</p>
            </a>
        </details>
        <details class="">
            <summary class="">Permisos</summary>
            <a href="{{ route('permissions.showBackOfficeIndex') }}" class="text-secondary">
                <p class="text-end me-5">Gestionar permisos</p>
            </a>
        </details>
        <details class="">
            <summary class="">Usuarios</summary>
            <a href="{{ route('users.showBackOfficeIndex') }}" class="text-secondary">
                <p class="text-end me-5">Gestionar usuarios</p>
            </a>
        </details>
    </div>
</div>

@endrole
@endsection

<input type="hidden" value="{{ env('APP_URL') }}" id="url">
<input type="hidden" id="offsetSelected" value="0">
<input type="hidden" id="filterSelected" value="0">

@section('js')
<script class="" src="{{ asset('js/productsCustomersFilter.js') }}" defer></script>
@endsection