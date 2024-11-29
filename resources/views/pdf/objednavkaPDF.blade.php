<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Faktura - {{$objednavka->id}} - Restaurace Na Rohu</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
    </style>
</head>

<body>
    <main class="p-20">
        <div class="flex items-center justify-between">
            <h1 class="font-extrabold text-3xl">Restaurace Na Rohu</h1>
            <p class="font-extrabold">Faktura - Daňový doklad - {{$objednavka->id}}</p>
        </div>

        <div class="flex items-start justify-between mt-10">
            <div class="flex flex-col items-start">
                <h2 class="mb-1 font-extrabold">Prodávající </h2>
                <p class="my-1">Název: Restaurace Na Rohu</p>
                <p class="my-1">Adresa: Karla IV. 13, 530 02 Pardubice I</p>
                <p class="my-1">Telefon: +420 123 456 789 </p>
                <p class="my-1">Email: info@narohu.cz </p>
                <p class="my-1">www: <a href="https://lequangdat.eu/">narohu.cz</a></p>
                <p class="my-1">IČO: 12345678</p>
                <p class="mt-1">DIČ: CZ12345678</p>
            </div>
            <div class="flex flex-col items-start">
                <p class="mb-1 font-extrabold">Kupující</p>
                <p class="my-1">Jméno a přijmení: Filip asas</p>
                <p class="my-1">Adresa: as 55, 55555 Přelouč</p>
                <p class="my-1">Email: datlequan@seznam.cz</p>
                <p class="mt-1">Telefon: 74136985</p>

            </div>
        </div>

        <div class="flex items-start justify-between mt-10">
            <div class="flex flex-col items-start">
                <p class="mb-1 font-extrabold">Daňový doklad: Faktura</p>
                <p class="my-1">Datum vystavení: {{$objednavka->created_at}}</p>
                <p class="my-1">Datum uskut. zdaň. plnění: {{$objednavka->created_at}}</p>
                <p class="my-1">Datum splatnosti: {{$objednavka->created_at}}</p>
                <p class="my-1">Datum převzetí: {{$objednavka->created_at}}</p>
                <p class="mt-1">Způsob úhrady: {{$objednavka->typ_platby->nazev}}</p>
            </div>
            <div class="flex flex-col items-start">
                <p class="mb-1 font-extrabold">Bankovní účet:</p>
                <p class="my-1">Název Banky: Česká spořitelna, a.s.</p>
                <p class="my-1">Číslo účtu: 1111111/0800</p>
                <p class="mt-1">Variabilní symbol: {{$objednavka->id}}</p>
            </div>
        </div>

        <div class="flex items-start justify-between mt-10">
            <div class="flex flex-col items-start">
                <h2 class="mb-1 font-extrabold">Název</h2>
                @foreach($produkty as $produkt)
                <p class="my-1">{{$produkt->menu_id->nazev}}</p>
                @endforeach
                <p class="mt-1 font-extrabold">Celkem</p>
            </div>
            <div class="flex flex-col items-start">
                <h2 class="mb-1 font-extrabold">Ks</h2>
                @foreach($produkty as $produkt)
                <p class="mt-1">{{$produkt->pocet}}</p>
                @endforeach
            </div>
            <div class="flex flex-col items-start">
                <h2 class="mb-1 font-extrabold">DPH v %</h2>
                <p class="mt-1">12</p>
            </div>
            <div class="flex flex-col items-start">
                <h2 class="mb-1 font-extrabold">Cena za ks</h2>
                @foreach($produkty as $produkt)
                <p class="mt-1">{{$produkt->cena}} Kč</p>
                @endforeach
            </div>
            <div class="flex flex-col items-start">
                <h2 class="mb-1 font-extrabold">Cena</h2>
                @foreach($produkty as $produkt)
                <p class="my-1">{{$produkt->pocet * $produkt->cena}} Kč</p>
                @endforeach
                <p class="mt-1 font-extrabold">{{$cena}} Kč</p>
            </div>
        </div>
    </main>
</body>

</html>