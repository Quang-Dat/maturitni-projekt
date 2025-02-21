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

    @vite(['resources/css/app.css', 'resources/js/app.js','resources/js/uspech.js', 'resources/js/nav.js'])



</head>

<body>
    <x-nav-bar></x-nav-bar>
    <main class="p-6 bg-gray-100 py-60 flex flex-col items-center justify-center">
        @if (session('success'))
        <div id="success" class="bg-green-100 w-full max-w-md text-center font-extrabold text-green-700 p-4 rounded mb-4 shadow">
            {{ session('success') }}
        </div>
        @endif
        <div class="bg-white p-6 rounded shadow-md w-full max-w-lg text-center">
            <h2 class="text-2xl font-bold text-gray-800 mb-4">Děkujeme za vaši objednávku č. {{$id}}</h2>
            <p class="text-gray-600">
                Vaše faktura je
                <a href="{{route('pdf', $id)}}" class="text-blue-500 hover:underline font-extrabold">zde</a>
            </p>
        </div>
    </main>
    <x-footer></x-footer>
</body>

</html>