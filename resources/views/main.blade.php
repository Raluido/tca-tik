@extends('layouts.master')

@section('content')

@guest

<div class="headerBottomWelcome">
    <div class="cardsContainer">
        @foreach($products as $product)
        <div class="card">
            @foreach($product->images as $image)
            <div class="imgContainer">
                <img src="{{ Storage::disk('images')->url($image->filename) }}" alt="" class="">
            </div>
            @endforeach
            <h4 class="">{{ $product->name }}</h4>
            <p class="">{{ $product->description }}</p>
            <h5 class="">{{ $product->price }}</h5>
        </div>
        @endforeach
    </div>

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

@section('js')
@endsection