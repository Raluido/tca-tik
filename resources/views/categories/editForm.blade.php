@extends('layouts.master')

@section('content')

<div class="">
    <form action="{{ route('categories.edit') }}" method="post" class="">
        @csrf
        @method('PUT')
        <div class="">
            <input type="text" name="name" value="{{ $category->name }}" placeholder="Nombre">
        </div>
        <div class="">
            <textarea name="description" id="" cols="30" rows="10" class="" placeholder="Descriptión la categoría"></textarea>
        </div>
        <div class="">
            <input type="text" name="prefix" value="{{ $category->prefix }}" placeholder="identificador de categoría">
        </div>
        <div class="">
            <input type="submit" value="Editar" class="">
        </div>
    </form>
</div>

@endsection

@section('js')

@endsection