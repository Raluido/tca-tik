@extends('layouts.master')

@section('content')

@guest

<h4>Bienvenido, logueese para acceder al panel de administrador</h4>

@endguest

@auth

<div class="controlPanel">

    <h4>Bienvenido al panel de administrador</h4>

    <div id="messages">
        @include('layouts.partials.messages')
    </div>

    <div class="controlPanelElements">
        <details class="">
            <summary class="">Productos</summary>
            <a href="{{ route('products.createForm') }}" class="">
                <h4 class="">Crear nuevo</h4>
            </a>
            <a href="{{ route('products.showall') }}" class="">
                <h4 class="">Mostrar todos</h4>
            </a>
        </details>
        <details class="">
            <summary class="">Categorias</summary>
            <a href="{{ route('categories.createForm') }}" class="">
                <h4 class="">Crear nueva</h4>
            </a>
            <a href="{{ route('categories.showall') }}" class="">
                <h4 class="">Mostrar todas</h4>
            </a>
        </details>
        <details class="">
            <summary class="">Almacenes</summary>
            <a href="{{ route('storehouses.createForm') }}" class="">
                <h4 class="">Crear nuevo</h4>
            </a>
            <a href="{{ route('storehouses.showall') }}" class="">
                <h4 class="">Mostrar todos</h4>
            </a>
        </details>
    </div>
</div>

@endauth

@endsection

@section('js')
<script type="module" defer>
    $(document).ready(function() {
        console.log("ready!");
    });
</script>
@endsection