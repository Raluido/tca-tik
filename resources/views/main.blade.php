@extends('layouts.master')

@section('content')

@guest

<div class="headerBottomWelcome">

    <h6 class="text-center mt-5">Bienvenido!</h6>

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
            <a href="{{ route('products.createForm') }}" class="text-secondary">
                <p class="text-end me-5">Crear nuevo</p>
            </a>
            <a href="{{ route('products.showall') }}" class="text-secondary">
                <p class="text-end me-5">Mostrar todos</p>
            </a>
        </details>
        <details class="">
            <summary class="">Categorias</summary>
            <a href="{{ route('categories.createForm') }}" class="text-secondary">
                <p class="text-end me-5">Crear nueva</p>
            </a>
            <a href="{{ route('categories.showall') }}" class="text-secondary">
                <p class="text-end me-5">Mostrar todas</p>
            </a>
        </details>
        <details class="">
            <summary class="">Almacenes</summary>
            <a href="{{ route('storehouses.createForm') }}" class="text-secondary">
                <p class="text-end me-5">Crear nuevo</p>
            </a>
            <a href="{{ route('storehouses.showall') }}" class="text-secondary">
                <p class="text-end me-5">Mostrar todos</p>
            </a>
        </details>
        <details class="">
            <summary class="">Gestionar almacenes</summary>
            <a href="{{ route('storehousesManagement.showProducts') }}" class="text-secondary">
                <p class="text-end me-5">Gestionar<br> almacenes</p>
            </a>
        </details>

        <hr>

        <details class="">
            <summary class="">Roles</summary>
            <a href="{{ route('roles.index') }}" class="text-secondary">
                <p class="text-end me-5">Gestionar roles</p>
            </a>
        </details>
        <details class="">
            <summary class="">Permisos</summary>
            <a href="{{ route('permissions.index') }}" class="text-secondary">
                <p class="text-end me-5">Gestionar permisos</p>
            </a>
        </details>
        <details class="">
            <summary class="">Usuarios</summary>
            <a href="{{ route('users.index') }}" class="text-secondary">
                <p class="text-end me-5">Gestionar usuarios</p>
            </a>
        </details>
    </div>
</div>

@endrole

@endsection

@section('js')
@endsection