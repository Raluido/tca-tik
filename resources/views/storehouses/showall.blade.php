@extends('layouts.master')

@section('content')

<div class="mt-5 d-flex flex-column align-items-center">

    <h4 class="text-center mb-5">Tabla de almacenes</h4>

    <div id="messages">
        @include('layouts.partials.messages')
    </div>

    @if(is_null($storehouses) || count($storehouses) == 0)
    <p id="noItems">Aún no has creado ningún almacén.</p>
    @else
    <div class="w-75">
        <table class="table">
            <thead class="">
                <tr class="">
                    <th class="">Nombre</th>
                    <th class="">Descripción</th>
                    <th class="">Dirección</th>
                    <th class="">Acción</th>
                </tr>
            </thead>
            <tbody class="">
                @foreach ($storehouses as $storehouse)
                <tr class="">
                    <td class="">{{$storehouse->name}}</td>
                    <td class="">{{$storehouse->description}}</td>
                    <td class="">{{$storehouse->address}}</td>
                    <td class=""><button class="blueButton"><a href="{{ route('storehouses.editForm', [$storehouse->id]) }}" class="text-white">Editar</a></button>
                        <button class="redButton text-white deleteStorehouse" value="{{ $storehouse->id }}">Eliminar</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif
    <div class="w-50 d-flex justify-content-evenly mt-5">
        <button class="greenButton"><a href="{{ route('storehouses.createForm') }}" class="text-white">Crear</a></button>
        <button class="blueButton"><a href="{{ route('main') }}" class="text-white">Volver</a></button>
    </div>
</div>

{{ $storehouses->links() }}

@endsection

@section('js')
<script class="" src="{{ asset('js/deleteConfirm.js') }}" defer></script>
@endsection