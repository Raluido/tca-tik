@extends('layouts.master')

@section('content')

<div class="">
    <form action="{{ route('categories.create') }}" method="post" class="">
        @csrf
        <div class="">
            <input type="text" name="name" class="" placeholder="Nombre">
        </div>
        <div class="">
            <textarea name="description" id="" cols="30" rows="10" class="" placeholder="Descriptión la categoría"></textarea>
        </div>
        <div class="">
            <input type="text" name="prefix" placeholder="identificador de categoría">
        </div>
        <div class="">
            <input type="submit" value="Crear" class="">
        </div>
    </form>
</div>

@endsection

@section('js')

@endsection