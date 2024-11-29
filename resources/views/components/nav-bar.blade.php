<header>
    <nav class="w-full flex h-24 items-center justify-between px-4 2xl:px-20 bg-hneda text-bila">
        <a class="font-playfair text-3xl 2xl:text-5xl font-extrabold" href="{{ route('index') }}">Restaurace Na Rohu</a>
        <div class="hidden 2xl:flex items-center">
            <a class="font-bold mx-5" href="{{route("index")}}#jidla">Jídelní lístek</a>
            <a class="font-bold mx-5" href="{{route("index")}}#piti">Nápojový lístek</a>
            <a class="font-bold mx-5" href="{{route("index")}}#o-nas">O nás</a>
            <a class="font-bold mx-5" href="{{route("index")}}#kontakty">Kontakty</a>
            <a class="font-bold mx-5" href="{{route("index")}}#recenze">Recenze</a>
            <a class="font-bold mx-5 px-5 py-3 bg-cervena rounded-full" href="{{route("produkty")}}">Objednejte si</a>
            <a class="font-bold mx-5" href="{{route("kosik")}}">
                <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" fill="currentColor" class="bi bi-cart4" viewBox="0 0 16 16">
                    <path d="M0 2.5A.5.5 0 0 1 .5 2H2a.5.5 0 0 1 .485.379L2.89 4H14.5a.5.5 0 0 1 .485.621l-1.5 6A.5.5 0 0 1 13 11H4a.5.5 0 0 1-.485-.379L1.61 3H.5a.5.5 0 0 1-.5-.5M3.14 5l.5 2H5V5zM6 5v2h2V5zm3 0v2h2V5zm3 0v2h1.36l.5-2zm1.11 3H12v2h.61zM11 8H9v2h2zM8 8H6v2h2zM5 8H3.89l.5 2H5zm0 5a1 1 0 1 0 0 2 1 1 0 0 0 0-2m-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0m9-1a1 1 0 1 0 0 2 1 1 0 0 0 0-2m-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0" />
                </svg>
            </a>
            <div class="user relative z-20 flex flex-col items-center mx-5">
                <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" fill="currentColor" class="bi bi-person-circle mx-5 font-bold cursor-pointer" viewBox="0 0 16 16">
                    <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0" />
                    <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1" />
                </svg>
                <div class="absolute top-[35px] w-max bg-white text-cerna rounded-lg shadow-lg hidden group-hover:block">
                    @if(Auth::check())
                    @if(Auth::user()->isAdmin())
                    <a href="{{ route('dashboard') }}" class="block px-4 py-2 hover:bg-gray-200 rounded-lg">Dashboard</a>
                    @endif
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="block w-full text-left px-4 py-2 hover:bg-gray-200 rounded-lg">Odhlásit se</button>
                    </form>
                    @else
                    <a href="{{ route('login') }}" class="block px-4 py-2 hover:bg-gray-200 rounded-lg">Přihlásit se</a>
                    <a href="{{ route('register') }}" class="block px-4 py-2 hover:bg-gray-200 rounded-lg">Registrovat se</a>
                    @endif
                </div>
            </div>
        </div>
        <!-- Mobile menu button -->
        <div class="2xl:hidden flex items-center">
            <button id="menu-toggle" class="text-bila focus:outline-none">
                <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" fill="currentColor" class="bi bi-list" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M2.5 12.5a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1h-10a.5.5 0 0 1-.5-.5zm0-5a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1h-10a.5.5 0 0 1-.5-.5zm0-5a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1h-10a.5.5 0 0 1-.5-.5z" />
                </svg>
            </button>
        </div>
    </nav>
    <!-- Mobile menu -->
    <div id="mobile-menu" class="hidden 2xl:hidden z-20 absolute w-full bg-hneda text-bila">
        <a class="block px-4 py-2 font-bold" href="{{route("index")}}#jidla">Jídelní lístek</a>
        <a class="block px-4 py-2 font-bold" href="{{route("index")}}#piti">Nápojový lístek</a>
        <a class="block px-4 py-2 font-bold" href="{{route("index")}}#o-nas">O nás</a>
        <a class="block px-4 py-2 font-bold" href="{{route("index")}}#kontakty">Kontakty</a>
        <a class="block px-4 py-2 font-bold" href="{{route("index")}}#recenze">Recenze</a>
        <a class="block px-4 py-2 font-bold bg-cervena rounded-full" href="{{route("produkty")}}">Objednejte si</a>
        <div class="flex items-center justify-around px-4 py-8">
            <a class="font-bold" href="{{route("kosik")}}">
                <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" fill="currentColor" class="bi bi-cart4" viewBox="0 0 16 16">
                    <path d="M0 2.5A.5.5 0 0 1 .5 2H2a.5.5 0 0 1 .485.379L2.89 4H14.5a.5.5 0 0 1 .485.621l-1.5 6A.5.5 0 0 1 13 11H4a.5.5 0 0 1-.485-.379L1.61 3H.5a.5.5 0 0 1-.5-.5M3.14 5l.5 2H5V5zM6 5v2h2V5zm3 0v2h2V5zm3 0v2h1.36l.5-2zm1.11 3H12v2h.61zM11 8H9v2h2zM8 8H6v2h2zM5 8H3.89l.5 2H5zm0 5a1 1 0 1 0 0 2 1 1 0 0 0 0-2m-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0m9-1a1 1 0 1 0 0 2 1 1 0 0 0 0-2m-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0" />
                </svg>
            </a>
            <div class="user relative z-20 flex flex-col items-center">
                <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" fill="currentColor" class="bi bi-person-circle mx-5 font-bold cursor-pointer" viewBox="0 0 16 16">
                    <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0" />
                    <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1" />
                </svg>
                <div class="absolute top-[35px] w-max bg-white text-cerna rounded-lg shadow-lg hidden group-hover:block">
                    @if(Auth::check())
                    @if(Auth::user()->isAdmin())
                    <a href="{{ route('dashboard') }}" class="block px-4 py-2 hover:bg-gray-200 rounded-lg">Dashboard</a>
                    @endif
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="block w-full text-left px-4 py-2 hover:bg-gray-200 rounded-lg">Odhlásit se</button>
                    </form>
                    @else
                    <a href="{{ route('login') }}" class="block px-4 py-2 hover:bg-gray-200 rounded-lg">Přihlásit se</a>
                    <a href="{{ route('register') }}" class="block px-4 py-2 hover:bg-gray-200 rounded-lg">Registrovat se</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</header>