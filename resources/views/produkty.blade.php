<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Restaurace Na Rohu</title>
    <link rel="icon" href="{{ asset("/storage/img/logo.jpg") }}" type="image/jpg" sizes="32x32">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Playfair+Display+SC:ital,wght@0,400;0,700;0,900;1,400;1,700;1,900&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js','resources/css/welcome.css', 'resources/js/nav.js', 'resources/js/ls-kosik.js'])


</head>

<body>
    <x-nav-bar></x-nav-bar>

    <main>
        <section class=" py-20 text-cerna my-20 flex flex-col items-center" id="jidla">
            <h2 class="text-3xl font-extrabold mb-12">Jídelní lístek</h2>

            @foreach($menu_kategorie as $kategorie)
            <div class="w-full flex flex-col items-center mt-12">
                <h3 class="text-2xl font-extrabold self-center"> {{ $kategorie->nazev }}</h3>
                @foreach($menu as $jidlo)

                @if ($jidlo->kategorie_id == $kategorie->id)
                <div class="flex flex-col items-center lg:flex-row lg:items-end justify-between w-[80%] my-5">
                    <div class="flex flex-col items-center lg:items-start max-w-[500px]">
                        <h4 class="text-center lg:text-start font-extrabold text-xl max-w-[190px] md:max-w-full nazev-{{ $jidlo->id }}">{{$jidlo->nazev}}</h4>
                        <p class="text-center lg:text-start max-w-[190px] md:max-w-full"> {{$jidlo->popis}}</p>
                    </div>
                    <div class="flex flex-col items-center lg:flex-row lg:items-center">
                        <p class="font-semibold text-xl my-1 cena-{{ $jidlo->id }}">{{$jidlo->cena}} Kč</p>
                        <input type="number" name="pocet" value="1" min="1" class="w-16 my-1 lg:ml-5 id-{{ $jidlo->id }}">
                        <button id="{{ $jidlo->id }}" class="font-bold my-1 lg:mx-5 px-5 py-3 bg-cervena rounded-full text-bila lg:ml-5">Koupit</button>
                    </div>
                </div>
                @endif

                @endforeach
            </div>
            @endforeach
        </section>
    </main>

    <x-footer></x-footer>
</body>

</html>