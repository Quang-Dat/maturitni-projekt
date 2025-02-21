<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Statistiky objednávek') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6 p-6">
                <form method="GET" class="flex gap-4 flex-col sm:flex-row">
                    <div>
                        <label for="pocatecni_datum" class="block text-sm font-medium text-gray-700">Od data</label>
                        <input type="date" name="pocatecni_datum" id="pocatecni_datum"
                            value="{{ request('pocatecni_datum') }}"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                    </div>
                    <div>
                        <label for="koncove_datum" class="block text-sm font-medium text-gray-700">Do data</label>
                        <input type="date" name="koncove_datum" id="koncove_datum"
                            value="{{ request('koncove_datum') }}"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                    </div>
                    <div class="flex items-end">
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Filtrovat
                        </button>
                    </div>
                </form>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <h3 class="text-lg font-semibold mb-4">Souhrnné statistiky</h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <div class="text-sm text-gray-600">Celkový počet objednávek</div>
                            <div class="text-2xl font-bold">{{ $celkoveSoucty['celkem_objednavek'] }}</div>
                        </div>
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <div class="text-sm text-gray-600">Celkový počet prodaných položek</div>
                            <div class="text-2xl font-bold">{{ $celkoveSoucty['celkove_mnozstvi'] }}</div>
                        </div>
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <div class="text-sm text-gray-600">Celkové tržby</div>
                            <div class="text-2xl font-bold">{{ number_format($celkoveSoucty['celkove_trzby'], 0, ',', ' ') }} Kč</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-semibold mb-4">Statistiky podle jídel</h3>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-md font-bold text-gray-700 uppercase tracking-wider">
                                        Název jídla
                                    </th>
                                    <th class="px-6 py-3 text-left text-md font-bold text-gray-700 uppercase tracking-wider">
                                        Počet prodaných
                                    </th>
                                    <th class="px-6 py-3 text-left text-md font-bold text-gray-700 uppercase tracking-wider">
                                        Celkové tržby
                                    </th>
                                    <th class="px-6 py-3 text-left text-md font-bold text-gray-700 uppercase tracking-wider">
                                        Počet objednávek
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($statistikyProduktu as $statistika)
                                <tr class="{{ $loop->even ? 'bg-gray-100' : '' }}">
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $statistika->nazev_produktu }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $statistika->celkem_prodano }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ number_format($statistika->celkove_trzby, 0, ',', ' ') }} Kč</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $statistika->pocet_objednavek }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>