<x-app-layout>
    <x-slot name="header" class="">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Nápoje') }}
        </h2>
        <x-nav-link class="mb-4" :href="route('napojovy_listek.create')" :active="request()->routeIs('napojovy_listek.create')">
            {{ __('Vytvořit') }}
        </x-nav-link>
        <div class="flex flex-col justify-center items-center md:flex-row mb-4">
            <p class="md:mr-8 my-2 md:my-0">Zobrazení:
                @if ($status === 'active')
                Aktivní Nápoje
                @elseif ($status === 'inactive')
                Neaktivní Nápoje
                @else
                Všechny Nápoje
                @endif
            </p>
            <a href="{{ url()->current() }}?status=all" class="text-blue-500 hover:text-blue-700 my-2 md:my-0">Všechny</a>
            <a href="{{ url()->current() }}?status=active" class="text-blue-500 hover:text-blue-700 md:ml-4 my-2 md:my-0">Aktivní</a>
            <a href="{{ url()->current() }}?status=inactive" class="text-blue-500 hover:text-blue-700 md:ml-4 my-2 md:my-0">Neaktivní</a>
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        <div class="overflow-x-auto bg-white shadow-md rounded-lg">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="px-6 py-3 text-left text-md font-bold text-gray-700 uppercase tracking-wider">Název</th>
                        <th class="px-6 py-3 text-left text-md font-bold text-gray-700 uppercase tracking-wider">Kategorie</th>
                        <th class="px-6 py-3 text-left text-md font-bold text-gray-700 uppercase tracking-wider">Popis</th>
                        <th class="px-6 py-3 text-left text-md font-bold text-gray-700 uppercase tracking-wider">Cena</th>
                        <th class="px-6 py-3 text-left text-md font-bold text-gray-700 uppercase tracking-wider">Akce</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($napoje as $radek)
                    <tr class="{{ $loop->even ? 'bg-gray-100' : '' }} hover:bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap text-md text-gray-700">{{ $radek->nazev }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-md text-gray-700">{{ $radek->kategorie->nazev }}</td>
                        <td class="px-6 py-4 text-md text-gray-700 max-w-[350px]">{{ $radek->popis }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-md text-gray-700">{{ $radek->cena }} Kč</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                            <a href="{{ route('napojovy_listek.edit', $radek->id) }}"
                                class="px-4 py-2 bg-yellow-300 text-gray-700 rounded-lg hover:bg-yellow-400 transition mr-2">
                                Upravit
                            </a>
                            <form action="{{ route('napojovy_listek.destroy', $radek->id) }}" method="POST" class="inline">
                                @csrf
                                @method('PATCH')
                                <button type="submit"
                                    class="{{ $radek->aktivni ? 'bg-red-500 hover:bg-red-600' : 'bg-green-500 hover:bg-green-600' }} px-4 py-2 text-white rounded-lg transition">
                                    {{ $radek->aktivni ? 'Deaktivovat' : 'Aktivovat' }}
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>