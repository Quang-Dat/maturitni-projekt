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
    @vite(['resources/js/nav.js'])
    @vite(['resources/js/uspech.js'])


</head>

<body>
    <x-nav-bar></x-nav-bar>
    <main>
        @if (session('success'))
        <div id="success" class="bg-green-100 w-full text-center font-extrabold text-green-700 p-4 rounded mb-4">
            {{ session('success') }}
        </div>
        @endif
        <div>
            <h2>Děkujeme za vaši objednávku č. {{$id}}</h2>
            <p>Vaše faktura je <a href="{{route("pdf", $id)}}">zde</a></p>
        </div>
    </main>
    <x-footer></x-footer>
</body>

</html>