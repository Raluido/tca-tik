@extends('layouts.master')

@section('content')

@auth

<div class="controlPanel">

    <h4>Bienvenido al panel de administrador</h4>

    <div class="controlPanelElements">
        <div class="">
            <a href="{{ route('product.showall') }}" class="">
                <h4 class="">Productos</h4>
            </a>
        </div>
        <div class="">
            <h4 class="">Categorias</h4>
        </div>
        <div class="">
            <h4 class="">Almacenes</h4>
        </div>
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