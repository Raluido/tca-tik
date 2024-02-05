@extends('layouts.master')

@section('content')

@guest

<div class="headerBottomWelcome">

    <h6 class="text-center mt-5">Bienvenido! <br><br> Logueese para acceder al panel de administrador.</h6>

</div>

@endguest

@auth

<div class="d-flex align-items-center flex-column headerBottom">

    <h6 class="text-center mt-5">Bienvenido al panel de administrador</h6>

    <div id="messages">
        @include('layouts.partials.messages')
    </div>

    <div class="controlPanelElements">
        <details class="">
            <summary class="">Productos</summary>
            <a href="{{ route('products.createForm') }}" class="">
                <p class="text-end me-5">Crear nuevo</p>
            </a>
            <a href="{{ route('products.showall') }}" class="">
                <p class="text-end me-5">Mostrar todos</p>
            </a>
        </details>
        <details class="">
            <summary class="">Categorias</summary>
            <a href="{{ route('categories.createForm') }}" class="">
                <p class="text-end me-5">Crear nueva</p>
            </a>
            <a href="{{ route('categories.showall') }}" class="">
                <p class="text-end me-5">Mostrar todas</p>
            </a>
        </details>
        <details class="">
            <summary class="">Almacenes</summary>
            <a href="{{ route('storehouses.createForm') }}" class="">
                <p class="text-end me-5">Crear nuevo</p>
            </a>
            <a href="{{ route('storehouses.showall') }}" class="">
                <p class="text-end me-5">Mostrar todos</p>
            </a>
        </details>
        <details class="">
            <summary class="">Gestionar almacenes</summary>
            <a href="{{ route('storehousesManagement.showall') }}" class="">
                <p class="text-end me-5">Gestionar<br> almacenes</p>
            </a>
        </details>
    </div>
</div>

@endauth

@endsection

@section('js')
@endsection