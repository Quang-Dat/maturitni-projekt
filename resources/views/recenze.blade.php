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


</head>

<body>
    <x-nav-bar></x-nav-bar>
    <main class="flex flex-col items-center">
        @if (session('success'))
        <div class="bg-green-100 w-full text-center font-extrabold text-green-700 p-4 rounded mb-4">
            {{ session('success') }}
        </div>
        @elseif (session('error'))
        <div class="bg-red-100 w-full text-center font-extrabold text-red-700 p-4 rounded mb-4">
            {{ session('error') }}
        </div>
        @endif
        <form class="p-10 mt-40 flex flex-col items-center bg-cervena rounded-lg text-bila w-[80%] md:w-1/2" action="{{ route('recenze.store') }}" method="POST">
            @csrf
            <h3 class="text-3xl font-extrabold mb-5">Napište recenzi</h3>
            <div class="flex flex-col items-start w-full my-3">
                <label class="mb-2 text-xl font-extrabold" for="hodnoceni">Hodnocení:</label>
                <select class="w-full rounded-lg p-1 bg-bila outline-none text-cerna focus:border-2" id="hodnoceni" name="hodnoceni" required>
                    @for ($i = 1; $i <= 5; $i++)
                        <option value="{{ $i }}">{{ $i }}</option>
                        @endfor
                </select>
            </div>
            <div class="flex flex-col items-start w-full my-3">
                <label class="mb-2 text-xl font-extrabold" for="recenze">Recenze:</label>
                <textarea class="w-full min-h-[150px] rounded-lg p-1 bg-bila outline-none text-cerna focus:border-2" id="recenze" name="recenze" required></textarea>
            </div>
            <button type="submit" class="py-1 px-3 rounded-lg mt-3 bg-zluta text-cerna font-extrabold text-xl">Odeslat</button>
        </form>
    </main> <x-footer></x-footer>
</body>

</html>