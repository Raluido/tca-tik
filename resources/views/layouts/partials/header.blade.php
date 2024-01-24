<div>
    <div id="mobileMenu"><img src="{{ Storage::url('mobileMenu.png') }}" alt="" class=""></div>
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
        <li class="">Principal</li>
        <li class="">Productos</li>
        <li class="">Blog</li>
        <li class="">Quienes somos</li>
    </ul>
</nav>