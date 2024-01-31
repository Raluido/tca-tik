@extends('layouts.master')

@section('content')

<div id="showall">

    <h3 class="">Tabla de productos</h3>

    <div id="messages">
        @include('layouts.partials.messages')
    </div>

    @if(is_null($products) || count($products) == 0)
    <p id="noItems">Aún no has creado ningún producto.</p>
    @else
    <div class="tableContainer">
        <table class="">
            <thead class="">
                <tr class="">
                    <th class="">Nombre</th>
                    <th class="">Categoría</th>
                    <th class="">Descripción</th>
                    <th class="">Precio</th>
                    <th class="">Observaciones</th>
                    <th class="">Mostrar</th>
                    <th class=""></th>
                </tr>
            </thead>
            <tbody class="">
                @foreach ($products as $product)
                <tr class="">
                    <td class="">{{$product->name}}</td>
                    <td class="">{{$product->categoryProduct->name}}</td>
                    <td class="">{{$product->description}}</td>
                    <td class="">{{$product->price}}</td>
                    <td class="">{{$product->observations}}</td>
                    <td class=""><button class="greenButton"><a href="{{ route('products.showone', [$product->id]) }}" class="text-white">Mostrar</a></button></td>
                    <td class=""><button class="blueButton"><a href="{{ route('products.editForm', [$product->id]) }}" class="text-white">Editar</a></button>
                        {{ html()->form('DELETE', '/products/' . $product->id . '/delete')->open() }}
                        {{ html()->submit('Borrar')->class(['redButton', 'text-white']) }}
                        {{ html()->form()->close() }}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif
    <div class="submitForm">
        <button class="greenButton"><a href="{{ route('products.createForm') }}" class="text-white">Crear</a></button>
        <button class="blueButton"><a href="{{ route('main') }}" class="text-white">Menú principal</a></button>
    </div>
</div>

@endsection