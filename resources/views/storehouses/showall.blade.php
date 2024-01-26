@extends('layouts.master')

@section('content')

<div class="">

    <h4 class="">Tabla de almacenes</h4>

    <div id="messages">
        @include('layouts.partials.messages')
    </div>

    @if(is_null($storehouses) || count($storehouses) == 0)
    <p class="">Aún no has creado ningún almacén.</p>
    @else
    <table class="">
        <thead class="">
            <tr class="">
                <th class="">Nombre</th>
                <th class="">Categoría</th>
                <th class="">Descripción</th>
                <th class="">Precio</th>
                <th class="">Observaciones</th>
                <th class="">Editar</th>
                <th class="">Eliminar</th>
            </tr>
        </thead>
        <tbody class="">
            @foreach (@storehouses as $storehouse)
            <tr class="">
                <td class="">{{$storehouse->name}}</td>
                <td class="">{{$storehouse->description}}</td>
                <td class="">{{$storehouse->address}}</td>
                <td class=""><button class="blueButton"><a href="{{ route('products.editForm', [$product->id]) }}" class="text-white">Editar</a></button></td>
                <td class="">{{ html()->form('DELETE', '/storehouses/' . $storehouse->id . '/delete')->open() }}
                    {{ html()->submit('Borrar')->class(['grayButton', 'text-white']) }}
                    {{ html()->form()->close() }}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @endif
    <div class="submitForm">
        <button class="greenButton"><a href="{{ route('storehouses.createForm') }}" class="text-white">Crear</a></button>
        <button class="blueButton"><a href="{{ route('main') }}" class="text-white">Menú principal</a></button>
    </div>
</div>

@endsection