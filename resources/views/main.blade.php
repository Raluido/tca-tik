@extends('layouts.master')

@section('content')

@guest

<h6 id="mainWelcome">Bienvenido! <br><br> Logueese para acceder al panel de administrador.</h6>

@endguest

@auth

<div class="controlPanel">

    <h6>Bienvenido al panel de administrador</h6>

    <div id="messages">
        @include('layouts.partials.messages')
    </div>

    <div class="controlPanelElements">
        <details class="">
            <summary class="">Productos</summary>
            <a href="{{ route('products.createForm') }}" class="">
                <h6 class="">Crear nuevo</h6>
            </a>
            <a href="{{ route('products.showall') }}" class="">
                <h6 class="">Mostrar todos</h6>
            </a>
        </details>
        <details class="">
            <summary class="">Categorias</summary>
            <a href="{{ route('categories.createForm') }}" class="">
                <h6 class="">Crear nueva</h6>
            </a>
            <a href="{{ route('categories.showall') }}" class="">
                <h6 class="">Mostrar todas</h6>
            </a>
        </details>
        <details class="">
            <summary class="">Almacenes</summary>
            <a href="{{ route('storehouses.createForm') }}" class="">
                <h6 class="">Crear nuevo</h6>
            </a>
            <a href="{{ route('storehouses.showall') }}" class="">
                <h6 class="">Mostrar todos</h6>
            </a>
        </details>
        <details class="">
            <summary class="">Gestionar almacenes</summary>
            <a href="{{ route('storehousesManagement.showall') }}" class="">
                <h6 class="">Gestionar almacenes</h6>
            </a>
        </details>
    </div>
</div>

@endauth

@endsection

@section('js')
@endsection