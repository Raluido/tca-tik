@extends('layouts.master')

@section('content')

<div class="">
    <h4 class="">Tabla de categorías</h4>

    <div id="messages">
        @include('layouts.partials.messages')
    </div>

    @if(is_null($categories) || count($categories) == 0)
    <p class="">Aún no has creado ningún producto.</p>
    @else
    <table class="">
        <thead class="">
            <tr class="">
                <th class="">Nombre</th>
                <th class="">Descripción</th>
                <th class="">Prefijo</th>
                <th class="">Editar</th>
                <th class="">Eliminar</th>
            </tr>
        </thead>
        <tbody class="">
            @foreach ($categories as $category)
            <tr class="">
                <td class="">{{$category->name}}</td>
                <td class="">{{$category->description}}</td>
                <td class="">{{$category->prefix}}</td>
                <td class=""><a href="{{ route('categories.editForm', [$category->id]) }}" class="">Editar</a></td>
                <td class="">{{$category->prefix}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @endif
    <div class="submitForm">
        <button class="greenButton"><a href="{{ route('categories.createForm') }}" class="text-white">Crear</a></button>
        <button class="blueButton"><a href="{{ route('main') }}" class="text-white">Menú principal</a></button>
    </div>
</div>

@endsection