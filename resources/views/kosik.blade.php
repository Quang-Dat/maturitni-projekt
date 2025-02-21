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

    @vite(['resources/css/app.css', 'resources/js/app.js','resources/css/welcome.css','resources/js/kosik.js', 'resources/js/nav.js'])


</head>

<body>
    <x-nav-bar></x-nav-bar>

    <main class="container mx-auto px-4">
        <section class="py-20 text-cerna my-20 flex flex-col items-center" id="jidla">
            <h2 class="text-3xl font-extrabold mb-12">Košík</h2>

            @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4 w-full max-w-4xl">
                {{ session('success') }}
            </div>
            @endif

            @if(session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4 w-full max-w-4xl">
                {{ session('error') }}
            </div>
            @endif

            <form action="{{route('kosik.store')}}" method="POST" class="w-full max-w-4xl">
                @csrf
                <div class="w-full flex flex-col items-center mb-8 bg-white p-6 rounded-lg shadow-md" id="vypis"> </div>

                <div class="bg-white p-8 rounded-lg shadow-md">
                    <div class="mb-8">
                        <h3 class="text-xl font-semibold mb-4 text-hneda">Osobní údaje</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="flex flex-col">
                                <label for="jmenoID" class="text-gray-700 mb-2">Jméno</label>
                                <input type="text" placeholder="Jméno" name="jmeno" id="jmenoID" required
                                    class="border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:border-hneda focus:ring-1 focus:ring-hneda">
                            </div>
                            <div class="flex flex-col">
                                <label for="prijmeniID" class="text-gray-700 mb-2">Přijmení</label>
                                <input type="text" placeholder="Přijmení" name="prijmeni" id="prijmeniID" required
                                    class="border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:border-hneda focus:ring-1 focus:ring-hneda">
                            </div>
                            <div class="flex flex-col">
                                <label for="emailID" class="text-gray-700 mb-2">Email</label>
                                <input type="email" placeholder="Email" name="email" id="emailID" required
                                    class="border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:border-hneda focus:ring-1 focus:ring-hneda">
                            </div>
                            <div class="flex flex-col">
                                <label for="telefonID" class="text-gray-700 mb-2">Telefonní číslo</label>
                                <input type="tel" placeholder="Telefonní číslo" name="telefon" id="telefonID" required
                                    class="border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:border-hneda focus:ring-1 focus:ring-hneda">
                            </div>
                        </div>
                    </div>

                    <div class="mb-8">
                        <h3 class="text-xl font-semibold mb-4 text-hneda">Způsob doručení a platby</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="flex flex-col">
                                <label for="typ_platbyID" class="text-gray-700 mb-2">Typ platby</label>
                                <select name="typ_platby" id="typ_platbyID" required
                                    class="border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:border-hneda focus:ring-1 focus:ring-hneda">
                                    @foreach($typ_platby as $platba)
                                    <option value={{$platba->id}}>{{$platba->nazev}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="flex flex-col">
                                <label for="typ_dopravyID" class="text-gray-700 mb-2">Typ dopravy</label>
                                <select name="typ_dopravy" id="typ_dopravyID" required
                                    class="border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:border-hneda focus:ring-1 focus:ring-hneda">
                                    @foreach($typ_dopravy as $doprava)
                                    <option value={{$doprava->id}}>{{$doprava->nazev}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="mb-8">
                        <h3 class="text-xl font-semibold mb-4 text-hneda">Doručovací adresa</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="flex flex-col">
                                <label for="uliceID" class="text-gray-700 mb-2">Ulice</label>
                                <input type="text" placeholder="Ulice" name="ulice" id="uliceID" required
                                    class="border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:border-hneda focus:ring-1 focus:ring-hneda">
                            </div>
                            <div class="flex flex-col">
                                <label for="cpID" class="text-gray-700 mb-2">Číslo popisné</label>
                                <input type="text" placeholder="Číslo popisné" name="cp" id="cpID" required
                                    class="border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:border-hneda focus:ring-1 focus:ring-hneda">
                            </div>
                            <div class="flex flex-col">
                                <label for="pscID" class="text-gray-700 mb-2">PSČ</label>
                                <input type="text" placeholder="PSČ" name="psc" id="pscID" required
                                    class="border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:border-hneda focus:ring-1 focus:ring-hneda">
                            </div>
                            <div class="flex flex-col">
                                <label for="mestoID" class="text-gray-700 mb-2">Město</label>
                                <input type="text" placeholder="Město" name="mesto" id="mestoID" required
                                    class="border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:border-hneda focus:ring-1 focus:ring-hneda">
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-center">
                        <button type="submit"
                            class="bg-hneda text-bila px-8 py-3 rounded-lg hover:bg-oranzova transition-colors duration-300 cursor-pointer font-semibold text-lg">
                            Objednat
                        </button>
                    </div>
                </div>
            </form>
        </section>
    </main>

    <x-footer></x-footer>
</body>

</html>