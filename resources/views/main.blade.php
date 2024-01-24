@extends('layouts.master')

@section('content')


<p>soy el main</p>

@endsection

@section('js')
<script type="text/javascript" defer>
    $( document ).ready(function() {
    console.log( "ready!" );
});
</script>
@endsection