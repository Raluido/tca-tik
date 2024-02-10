@extends('layouts.master')

@section('content')

<div class="mt-5 d-flex flex-column align-items-center flex-grow-1 headerBottom">

    <h4 class="text-center mb-5">Tabla de categorías</h4>

    <div id="messages">
        @include('layouts.partials.messages')
    </div>

    @if(is_null($categories) || count($categories) == 0)
    <p id="noItems">Aún no has creado ninguna categoría.</p>
    @else
    <div class="tableWidth">
        <table class="table">
            <thead class="">
                <tr class="">
                    <th class="">Nombre</th>
                    <th class="">Descripción</th>
                    <th class="">Prefijo</th>
                    <th class="">Acciones</th>
                </tr>
            </thead>
            <tbody class="">
                @foreach ($categories as $category)
                <tr class="">
                    <td class="">{{$category->name}}</td>
                    <td class="">{{$category->description}}</td>
                    <td class="">{{$category->prefix}}</td>
                    <td class=""><button class="btn btn-primary btn-sm"><a href="{{ route('categories.showBackOfficeEdit', [$category->id]) }}" class="text-white">Editar</a></button>
                        <button class="btn btn-danger btn-sm deleteCategory" value="{{ $category->id }}">Eliminar</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{ $categories->links() }}
    </div>
    @endif

    <div class="w-50 d-flex justify-content-evenly mt-5">
        <button class="btn btn-success btn-sm text-white"><a href="{{ route('categories.showBackOfficeCreate') }}" class="text-white">Crear</a></button>
        <button class="btn btn-primary btn-sm text-white"><a href="{{ route('main') }}" class="text-white">Volver</a></button>
    </div>
</div>

@endsection

@section('js')
<script class="" src="{{ asset('js/deleteConfirm.js') }}" defer></script>
@endsection