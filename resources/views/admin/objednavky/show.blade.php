<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detail objednávky #' . $objednavka->id) }}
        </h2>
    </x-slot>

    @if (session('success'))
    <div class="bg-green-100 text-green-700 p-4 rounded mb-4">
        {{ session('success') }}
    </div>
    @endif

    @if(session('error'))
    <div class="bg-red-100 text-red-700 p-4 rounded mb-4">
        {{ session('error') }}
    </div>
    @endif

    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <div class="mb-6 bg-white shadow-md rounded-lg p-4 sm:p-6">
            <h3 class="text-lg font-semibold text-gray-700 mb-4">Zákazník</h3>
            <div class="space-y-2">
                <p class="text-gray-600 text-sm sm:text-base"><strong>Jméno:</strong> {{ $objednavka->jmeno }} {{ $objednavka->prijmeni }}</p>
                <p class="text-gray-600 text-sm sm:text-base"><strong>Email:</strong> {{ $objednavka->email }}</p>
                <p class="text-gray-600 text-sm sm:text-base"><strong>Telefon:</strong> {{ $objednavka->telefon }}</p>
                <p class="text-gray-600 text-sm sm:text-base break-words"><strong>Adresa:</strong> {{ $objednavka->ulice . " " . $objednavka->cp . ", " . $objednavka->psc . " " . $objednavka->mesto }}</p>
                <p class="text-gray-600 text-sm sm:text-base"><strong>Způsob dopravy:</strong> {{ $objednavka->typ_dopravy->nazev }}</p>
                <p class="text-gray-600 text-sm sm:text-base"><strong>Způsob platby:</strong> {{ $objednavka->typ_platby->nazev }}</p>
                <p class="text-gray-600 text-sm sm:text-base">
                    <strong>Stav objednávky:</strong>
                    <span class="whitespace-nowrap text-md font-extrabold {{ $objednavka->doruceno ? 'text-green-600' : 'text-yellow-500' }}">
                        {{ $objednavka->doruceno ? 'Dokončená' : 'Připravujeme' }}
                    </span>
                </p>
            </div>
        </div>

        <div class="mb-6 bg-white shadow-md rounded-lg p-4 sm:p-6 overflow-x-auto">
            <h3 class="text-lg font-semibold text-gray-700 mb-4">Položky objednávky</h3>
            <div class="min-w-full overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-md font-bold text-gray-700 uppercase tracking-wider">Název produktu</th>
                            <th class="px-6 py-3 text-left text-md font-bold text-gray-700 uppercase tracking-wider">Cena</th>
                            <th class="px-6 py-3 text-left text-md font-bold text-gray-700 uppercase tracking-wider">Množství</th>
                            <th class="px-6 py-3 text-left text-md font-bold text-gray-700 uppercase tracking-wider">Celkem</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($objednavka->prodVObj as $item)
                        <tr class="{{ $loop->even ? 'bg-gray-100' : '' }}">
                            <td class="px-4 sm:px-6 py-4 text-sm text-gray-700">{{ $item->menu_id->nazev }}</td>
                            <td class="px-4 sm:px-6 py-4 text-sm text-gray-700">{{ $item->cena }} Kč</td>
                            <td class="px-4 sm:px-6 py-4 text-sm text-gray-700">{{ $item->pocet }}</td>
                            <td class="px-4 sm:px-6 py-4 text-sm text-gray-700">{{ $item->cena * $item->pocet }} Kč</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="mb-6 bg-white shadow-md rounded-lg p-4 sm:p-6 flex flex-col items-center">
            <h3 class="text-lg font-semibold text-gray-700 mb-4">Celková cena</h3>
            <p class="text-xl sm:text-2xl font-bold text-gray-800">{{ $objednavka->total_price }} Kč</p>
        </div>

        <div class="flex flex-col sm:flex-row items-center space-y-4 sm:space-y-0 sm:space-x-4">
            @if($objednavka->doruceno !== 1)
            <form action="{{ route('objednavka.dokoncit', $objednavka->id) }}" method="POST">
                @csrf
                <button type="submit" class="w-full sm:w-auto px-6 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600 transition">
                    Dokončit objednávku
                </button>
            </form>
            @endif
            <a href="{{ route('objednavky.index') }}" class="w-max px-6 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition text-center">
                Zpět na seznam
            </a>
        </div>
    </div>
</x-app-layout>