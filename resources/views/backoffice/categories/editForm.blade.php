@extends('layouts.master')

@section('content')

<div class="d-flex flex-column align-items-center flex-grow-1 headerBottom">

    <h4 class="mt-5">Editar categoría</h4>

    <div id="messages">
        @include('layouts.partials.messages')
    </div>

    <div class="formWidth">
        <form action="{{ route('categories.backOfficeupdate', [$category->id]) }}" method="post" id="sendForm" class="mt-5 shadow-lg text-center py-5">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <input type="text" name="name" class="w-75" value="{{ $category->name }}" id="nameValidator" placeholder="Nombre">
                <h5 id="nameError"></h5>
            </div>
            <div class="mb-4">
                <textarea name="description" rows="10" class="w-75" id="descriptionValidator" placeholder="Descriptión la categoría"><?php echo $category->description ?></textarea>
                <h5 id="descriptionError"></h5>
            </div>
            <div class="mb-5">
                <input type="text" name="prefix" value="{{ $category->prefix }}" class="w-75" id="prefixValidator" placeholder="identificador de categoría">
                <h5 id="prefixError"></h5>
            </div>

            <div class="w-100 mt-5 d-flex justify-content-evenly">
                <button class="btn btn-success btn-sm" id="submitBtn">Editar</button>
                <button class="btn btn-primary btn-sm"><a href="{{ route('main') }}" class="text-white">Volver</a></button>
            </div>
        </form>
    </div>
</div>

@endsection

@section('js')
<script class="" type="module" src="{{ asset('js/validatorCat.js') }}" defer></script>
@endsection