<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Seznam objednávek') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        @if(session('success'))
        <div class="mb-4 p-4 text-sm text-green-700 bg-green-100 rounded-lg" role="alert">
            {{ session('success') }}
        </div>
        @endif

        <div class="overflow-x-auto bg-white shadow-md rounded-lg">
            <table class="min-w-full divide-y divide-gray-200 overflow-x-auto">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="px-6 py-3 text-left text-md font-bold text-gray-700 uppercase tracking-wider">ID</th>
                        <th class="px-6 py-3 text-left text-md font-bold text-gray-700 uppercase tracking-wider">Jméno zákazníka</th>
                        <th class="px-6 py-3 text-left text-md font-bold text-gray-700 uppercase tracking-wider">Email</th>
                        <th class="px-6 py-3 text-left text-md font-bold text-gray-700 uppercase tracking-wider">Telefon</th>
                        <th class="px-6 py-3 text-left text-md font-bold text-gray-700 uppercase tracking-wider">Celková cena</th>
                        <th class="px-6 py-3 text-left text-md font-bold text-gray-700 uppercase tracking-wider">Stav</th>
                        <th class="px-6 py-3 text-left text-md font-bold text-gray-700 uppercase tracking-wider">Akce</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($objednavky as $objednavka)
                    <tr class="{{ $loop->even ? 'bg-gray-100' : '' }}">
                        <td class="px-6 py-4 whitespace-nowrap text-md text-gray-700">{{ $objednavka->id }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-md text-gray-700">{{ $objednavka->jmeno }} {{ $objednavka->prijmeni }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-md text-gray-700">{{ $objednavka->email }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-md text-gray-700">{{ $objednavka->telefon }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-md text-gray-700">{{ $objednavka->total_price }} Kč</td>
                        <td class="px-6 py-4 whitespace-nowrap text-md font-semibold {{ $objednavka->doruceno ? 'text-green-600' : 'text-yellow-500' }}">
                            {{ $objednavka->doruceno ? 'Dokončená' : 'Připravujeme' }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                            <a href="{{ route('objednavka.show', $objednavka) }}"
                                class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition">
                                Zobrazit
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>