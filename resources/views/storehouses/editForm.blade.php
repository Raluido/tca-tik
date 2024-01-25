@extends('layouts.master')

@section('content')

<div class="">
    <form action="{{ route('storehouses.edit') }}" method="post" class="">
        @csrf
        <div class="">
            <input type="text" name="name" value="{{ $storehouse->name }}" placeholder="Nombre">
        </div>
        <div class="">
            <textarea name="description" id="" cols="30" rows="10" class="" placeholder="Descriptión del almacén"></textarea>
        </div>
        <div class="">
            <input type="text" name="address" value="{{ $storehouse->address }}" placeholder="Dirección">
        </div>
        <div class="">
            <input type="submit" value="Crear" class="">
        </div>
    </form>
</div>

@endsection

@section('js')

@endsection