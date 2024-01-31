<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}" class="">
    <title>tca-tik</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>

    <div id="pageContainer">

        <header class="">
            @include('layouts.partials.header')
        </header>

        <main class="">
            @yield('content')
        </main>
        
        <footer class="">
            @include('layouts.partials.footer')
        </footer>

    </div>

</body>

<script type="module" src="{{ asset('js/showMobileMenu.js') }}" defer></script>

@yield('js')


</html>