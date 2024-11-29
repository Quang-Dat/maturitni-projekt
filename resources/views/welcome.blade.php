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
    <main>
        <section id="uvod">
            <div class="relative h-screen w-full">
                <img class="-z-10 h-screen w-full object-cover" src="{{ asset('storage/img/uvodni-obr.jpg') }}" alt="">
                <div class="absolute inset-0 bg-black opacity-50"></div>
            </div>
            <!-- right-56 -->
            <div class="w-[90%] lg:w-max flex flex-col items-center lg:items-start justify-center text-bila absolute top-1/2 left-1/2 transform -translate-y-1/2 -translate-x-1/2 lg:left-auto lg:right-56 lg:-translate-x-0">
                <h1 class="mb-2 text-4xl lg:text-7xl font-extrabold text-center lg:text-start">Restaurace Na Rohu</h1>
                <p class="my-2 text-2xl font-bold text-center lg:text-start">Tradiční česká kuchyně v útulném prostředí přímo v srdci města.</p>
                <div class="mt-3 flex flex-row items-center justify-center flex-wrap">
                    <a class="bg-oranzova px-5 py-3 rounded-full font-bold m-2 lg:ml-0" href="#jidla">Jídelní lístek</a>
                    <a class="bg-oranzova px-5 py-3 rounded-full font-bold m-2" href="#piti">Nápojový lístek</a>
                </div>
            </div>
        </section>

        <section class="bg-cervena py-20 text-bila flex flex-col items-center" id="jidla">
            <h2 class="text-3xl font-extrabold mb-12">Jídelní lístek</h2>

            @foreach($menu_kategorie as $kategorie)
            <div class="w-full flex flex-col items-center mt-12">
                <h3 class="text-2xl font-extrabold self-center"> {{ $kategorie->nazev }}</h3>
                @foreach($menu as $jidlo)

                @if ($jidlo->kategorie_id == $kategorie->id)
                <div class="flex items-end justify-between w-[80%] my-5">
                    <div class="flex flex-col items-start max-w-[500px]">
                        <h4 class="text-start font-extrabold text-xl max-w-[190px] md:max-w-full">{{$jidlo->nazev}}</h4>
                        <p class=" max-w-[190px] md:max-w-full"> {{$jidlo->popis}}</p>
                    </div>
                    <p class="font-semibold text-xl">{{$jidlo->cena}} Kč</p>
                </div>
                @endif

                @endforeach
            </div>
            @endforeach
        </section>
        <img class="w-full" src="{{ asset('storage/img/tilt.svg') }}" alt="">

        <section class="mt-20 py-20  flex flex-col items-center mb-20" id="piti">
            <h2 class="text-3xl font-extrabold mb-12">Nápojový lístek</h2>

            @foreach($piti_kategorie as $kategorie)
            <div class="w-full flex flex-col items-center mt-12">
                <h3 class="text-2xl font-extrabold self-center"> {{ $kategorie->nazev }}</h3>
                @foreach($piti_data as $piti)

                @if ($piti->kategorie_id == $kategorie->id)
                <div class="flex items-end justify-between w-[80%] my-5">
                    <div class="flex flex-col items-start max-w-[500px]">
                        <h4 class="text-start font-extrabold text-xl max-w-[190px] md:max-w-full">{{$piti->nazev}}</h4>
                        <p class="max-w-[190px] md:max-w-full"> {{$piti->popis}}</p>
                    </div>
                    <p class="font-semibold text-xl">{{$piti->cena}} Kč</p>
                </div>
                @endif

                @endforeach
            </div>
            @endforeach
        </section>

        <section id="o-nas" class="flex flex-col text-bila items-center bg-cervena py-20">
            <h2 class="text-3xl mb-20 font-extrabold">O nás</h2>
            <div class="flex flex-col lg:flex-row justify-around items-center">
                <img class="w-[90%] lg:w-[40%] object-cover mb-5 lg:mb-0" src="{{ asset('storage/img/uvodni-obr.jpg') }}" alt="">
                <p class="w-[90%] lg:w-[40%]">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quibusdam blanditiis nulla, dicta consequatur reiciendis perspiciatis totam explicabo expedita dolore eaque doloribus assumenda repellendus aut dolorum error cumque commodi dolor? Ad. Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quibusdam blanditiis nulla, dicta consequatur reiciendis perspiciatis totam explicabo expedita dolore eaque doloribus assumenda repellendus aut dolorum error cumque commodi dolor? Ad Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quibusdam blanditiis nulla, dicta consequatur reiciendis perspiciatis totam explicabo expedita dolore eaque doloribus assumenda repellendus aut dolorum error cumque commodi dolor? Ad Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quibusdam blanditiis nulla, dicta consequatur reiciendis perspiciatis totam explicabo expedita dolore eaque doloribus assumenda repellendus aut dolorum error cumque commodi dolor? Ad</p>
            </div>
        </section>

        <section id="galerie" class="py-20 my-20 flex flex-col items-center">
            <h2 class="text-3xl font-extrabold mb-10">Galerie</h2>
            <div class="flex flex-col items-center">
                <div class="flex items-center justify-around flex-col md:flex-row">
                    <img class="w-[90%] md:w-[40%] object-cover my-10" src="{{ asset('storage/img/uvodni-obr.jpg') }}" alt="">
                    <img class="w-[90%] md:w-[40%] object-cover my-10" src="{{ asset('storage/img/uvodni-obr.jpg') }}" alt="">
                </div>
                <div class="flex items-center justify-around flex-col md:flex-row">
                    <img class="w-[90%] md:w-[40%] object-cover my-10" src="{{ asset('storage/img/uvodni-obr.jpg') }}" alt="">
                    <img class="w-[90%] md:w-[40%] object-cover my-10" src="{{ asset('storage/img/uvodni-obr.jpg') }}" alt="">
                </div>
                <div class="flex items-center justify-around flex-col md:flex-row">
                    <img class="w-[90%] md:w-[40%] object-cover my-10" src="{{ asset('storage/img/uvodni-obr.jpg') }}" alt="">
                    <img class="w-[90%] md:w-[40%] object-cover my-10" src="{{ asset('storage/img/uvodni-obr.jpg') }}" alt="">
                </div>
            </div>
        </section>

        <section class="bg-cervena my-20 py-20 flex flex-col items-center text-bila" id="recenze">
            <div class="mb-20">
                <h2 class="text-3xl font-extrabold mb-5">Recenze</h2>
                <a class="py-1 px-3 rounded-lg mt-7 bg-zluta text-cerna font-extrabold text-xl" href="{{route("recenze")}}">Napište recenzi</a>
            </div>
            <div class="w-full flex items-center justify-around">
                <button id="recenze-leva" class="bg-oranzova rounded-full ">
                    <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-arrow-left-short" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M12 8a.5.5 0 0 1-.5.5H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5a.5.5 0 0 1 .5.5" />
                    </svg>
                </button>
                @foreach($recenze as $radek)
                <div class=" {{$loop->index > 0 ? "hidden":" w-[60%] flex flex-col items-center"}}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-person-circle mb-2" viewBox="0 0 16 16">
                        <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0" />
                        <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1" />
                    </svg>
                    <h3 class="my-2 font-extrabold text-xl">{{$radek->user->email}}</h3>
                    <div class="my-2"> {{$radek->hodnoceni}} </div>
                    <p class="mt-2 text-center">{{$radek->recenze}} </p>
                </div>
                @endforeach
                <button id="recenze-prava" class="bg-oranzova rounded-full rotate-180">
                    <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-arrow-left-short" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M12 8a.5.5 0 0 1-.5.5H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5a.5.5 0 0 1 .5.5" />
                    </svg>
                </button>
            </div>
        </section>

        <section id="kontakty" class="my-20 py-20 flex flex-col items-center">
            <h2 class="text-3xl font-extrabold mb-20">Kontakty</h2>
            <div class="flex flex-wrap flex-col md:flex-row items-center justify-around w-[80%]">
                <div class="mb-5 mr-5">
                    <div class="flex items-center justify-start mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-envelope-fill" viewBox="0 0 16 16">
                            <path d="M.05 3.555A2 2 0 0 1 2 2h12a2 2 0 0 1 1.95 1.555L8 8.414zM0 4.697v7.104l5.803-3.558zM6.761 8.83l-6.57 4.027A2 2 0 0 0 2 14h12a2 2 0 0 0 1.808-1.144l-6.57-4.027L8 9.586zm3.436-.586L16 11.801V4.697z" />
                        </svg>
                        <a class="ml-3" href="mailto:info@narohu.cz">info@narohu.cz</a>
                    </div>
                    <div class="flex items-center my-4">
                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-telephone-fill" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M1.885.511a1.745 1.745 0 0 1 2.61.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.68.68 0 0 0 .178.643l2.457 2.457a.68.68 0 0 0 .644.178l2.189-.547a1.75 1.75 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.6 18.6 0 0 1-7.01-4.42 18.6 18.6 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877z" />
                        </svg>
                        <a class="ml-3" href="tel:+420123456789">+420 123 456 789</a>
                    </div>
                    <div class="flex items-center my-4">
                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-geo-alt-fill" viewBox="0 0 16 16">
                            <path d="M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10m0-7a3 3 0 1 1 0-6 3 3 0 0 1 0 6" />
                        </svg>
                        <a class="ml-3" href="https://www.google.com/maps/place/SP%C5%A0E+a+VO%C5%A0+Pardubice/@50.0373833,15.7771809,17z/data=!3m1!4b1!4m6!3m5!1s0x470dcced2c0f99a9:0x13e68abed8193137!8m2!3d50.0373799!4d15.7797558!16s%2Fg%2F121hfvqw?entry=ttu&g_ep=EgoyMDI0MTAyMy4wIKXMDSoASAFQAw%3D%3D">Karla IV. 13, 530 02 Pardubice I</a>
                    </div>
                    <div class="flex items-center my-4">
                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-clock-fill" viewBox="0 0 16 16">
                            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71z" />
                        </svg>
                        <p class="ml-3">Po-Ne: 11-22</p>
                    </div>
                    <div class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-facebook" viewBox="0 0 16 16">
                            <path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951" />
                        </svg>
                        <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-instagram mx-4" viewBox="0 0 16 16">
                            <path d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.9 3.9 0 0 0-1.417.923A3.9 3.9 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.9 3.9 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.9 3.9 0 0 0-.923-1.417A3.9 3.9 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599s.453.546.598.92c.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.5 2.5 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.5 2.5 0 0 1-.92-.598 2.5 2.5 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233s.008-2.388.046-3.231c.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92s.546-.453.92-.598c.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92m-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217m0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334" />
                        </svg>
                        <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-tiktok" viewBox="0 0 16 16">
                            <path d="M9 0h1.98c.144.715.54 1.617 1.235 2.512C12.895 3.389 13.797 4 15 4v2c-1.753 0-3.07-.814-4-1.829V11a5 5 0 1 1-5-5v2a3 3 0 1 0 3 3z" />
                        </svg>
                    </div>
                </div>
                <iframe class="w-[90%] md:w-[600px] md:h-[450px]" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2562.6110649708658!2d15.777180876913269!3d50.037383317019106!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x470dcced2c0f99a9%3A0x13e68abed8193137!2sSP%C5%A0E%20a%20VO%C5%A0%20Pardubice!5e0!3m2!1scs!2scz!4v1730193420527!5m2!1scs!2scz" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
            <form class="p-10 mt-40 flex flex-col items-center bg-cervena rounded-lg text-bila w-[80%] md:w-1/2" action="">
                <h3 class="text-3xl font-extrabold mb-5">Napište nám</h3>
                <div class="flex flex-col items-start w-full my-3">
                    <label class="mb-2 text-xl font-extrabold" for="emailID">Email:</label>
                    <input class="w-full rounded-lg p-1 bg-bila outline-none text-cerna focus:border-2 " required type="email" name="email" id="emailID">
                </div>
                <div class="flex flex-col items-start w-full my-3">
                    <label class="mb-2 text-xl font-extrabold" for="predmetID">Předmět:</label>
                    <input class="w-full rounded-lg p-1 bg-bila outline-none text-cerna focus:border-2 " required type="text" name="predmet" id="predmetID">
                </div>
                <div class="flex flex-col items-start w-full my-3">
                    <label class="mb-2 text-xl font-extrabold" for="zpravaID">Zpráva</label>
                    <textarea class="w-full min-h-[350px] rounded-lg p-1 bg-bila outline-none text-cerna focus:border-2 " required name="zprava" id="zpravaID"></textarea>
                </div>
                <input type="submit" value="Odeslat" class="py-1 px-3 rounded-lg mt-3 bg-zluta text-cerna font-extrabold text-xl">
            </form>
        </section>
    </main>

    <x-footer></x-footer>
</body>

</html>