<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Restaurace Na Rohu</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Playfair+Display+SC:ital,wght@0,400;0,700;0,900;1,400;1,700;1,900&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @vite(['resources/css/welcome.css'])
    @vite(['resources/js/nav.js'])
    @vite(['resources/js/kosik.js'])


</head>

<body>
    <x-nav-bar></x-nav-bar>

    <main>
        <section class=" py-20 text-cerna my-20 flex flex-col items-center" id="jidla">
            <h2 class="text-3xl font-extrabold mb-12">Košík</h2>
            @if(session('success'))
            <div>{{ session('success') }}</div>
            @endif
            @if(session('error'))
            <div>{{ session('error') }}</div>
            @endif
            <form action="{{route("kosik.store")}}" method="POST" class="w-full flex-col items-center">
                @csrf
                <div class="w-full flex flex-col items-center mt-12" id="vypis"></div>
                <div><label for="jmenoID">Jméno</label><input type="text" placeholder="Jméno" name="jmeno" id="jmenoID"></div>
                <div><label for="prijmeniID">Přijmení</label><input type="text" placeholder="Přijmení" name="prijmeni" id="prijmeniID"></div>
                <div><label for="emailID">Email</label><input type="email" placeholder="Email" name="email" id="emailID"></div>
                <div><label for="telefonID">Telefonní čislo</label><input type="text" placeholder="Telefonní číslo" name="telefon" id="telefonID"></div>
                <div>
                    <label for="typ_platbyID">Typ platby:</label>
                    <select name="typ_platby" id="typ_platbyID">
                        @foreach($typ_platby as $platba)
                        <option value={{$platba->id}}>{{$platba->nazev}}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="typ_dopravyID">Typ dopravy:</label>
                    <select name="typ_dopravy" id="typ_dopravyID">
                        @foreach($typ_dopravy as $doprava)
                        <option value={{$doprava->id}}>{{$doprava->nazev}}</option>
                        @endforeach
                    </select>
                </div>
                <div><label for="uliceID">Ulice</label><input type="text" placeholder="Ulice" name="ulice" id="uliceID"></div>
                <div><label for="cpID">Číslo popisné</label><input type="text" placeholder="Číslo popisné" name="cp" id="cpID"></div>
                <div><label for="pscID">PSČ</label><input type="text" placeholder="PSČ" name="psc" id="pscID"></div>
                <div><label for="mestoID">Město</label><input type="text" placeholder="Město" name="mesto" id="mestoID"></div>
                <input type="submit" value="Objednat">
            </form>
        </section>
    </main>

    <x-footer></x-footer>
</body>