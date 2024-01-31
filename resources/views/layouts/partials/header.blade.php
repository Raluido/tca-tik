<div>
    <div id="mobileMenu"><img src="{{ Storage::url('mobileMenu.png') }}" alt="" class=""></div>
    <div id="dropDown" class="d-none">
        <ul class="">
            <li class=""><a href="{{ route('main') }}" class="">Principal</a></li>
            <li class=""><a href="{{ route('products.showall') }}" class="">Productos</a></li>
            <li class=""><a href="{{ route('storehouses.showall') }}" class="">Almacenes</a></li>
            <li class=""><a href="{{ route('categories.showall') }}" class="">Categorías</a></li>
            <li class=""><a href="{{ route('main') }}" class="">Blog</a></li>
            <li class=""><a href="{{ route('main') }}" class="">Quienes somos</a></li>
        </ul>
    </div>
    <div id="desktopMenuDummie"></div>
    <div id="logo">
        <img src="{{ Storage::url('logo.jpeg') }}" alt="" class="">
    </div>
    <div id="login">
        @if(auth()->id())
        <a href="{{ route('login.logout') }}" class="">Logout</a>
        @else
        <a href="{{ route('login.show') }}" class="">Login</a>
        @endif
    </div>
</div>
<nav id="desktopMenu">
    <ul class="">
        <li class=""><a href="{{ route('main') }}" class="">Principal</a></li>
        <li class=""><a href="{{ route('products.showall') }}" class="">Productos</a></li>
        <li class=""><a href="{{ route('storehouses.showall') }}" class="">Almacenes</a></li>
        <li class=""><a href="{{ route('categories.showall') }}" class="">Categorías</a></li>
        <li class=""><a href="{{ route('main') }}" class="">Blog</a></li>
        <li class=""><a href="{{ route('main') }}" class="">Quienes somos</a></li>
    </ul>
</nav>