@extends('layouts.master')

@section('content')

<div class="mt-5 d-flex flex-column align-items-center">

    <h4 class="text-center mb-5">Tabla de categorías</h4>

    <div id="messages">
        @include('layouts.partials.messages')
    </div>

    @if(is_null($categories) || count($categories) == 0)
    <p id="noItems">Aún no has creado ninguna categoría.</p>
    @else
    <div class="w-75">
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
                    <td class=""><button class="blueButton"><a href="{{ route('categories.editForm', [$category->id]) }}" class="text-white">Editar</a></button>
                        <button class="redButton text-white deleteCategory" value="{{ $category->id }}">Eliminar</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif
    <div class="w-50 d-flex justify-content-evenly mt-5">
        <button class="greenButton"><a href="{{ route('categories.createForm') }}" class="text-white">Crear</a></button>
        <button class="blueButton"><a href="{{ route('main') }}" class="text-white">Volver</a></button>
    </div>
</div>

{{ $categories->links() }}

@endsection

@section('js')
<script class="" src="{{ asset('js/deleteConfirm.js') }}" defer></script>
@endsection