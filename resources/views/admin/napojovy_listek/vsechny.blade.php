<x-app-layout>
    <x-slot name="header" class="">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight my-2 md:my-0">
            {{ __('Nápoje') }}
        </h2>
        <x-nav-link class=" my-2 md:my-0" :href="route('napojovy_listek.create')" :active="request()->routeIs('napojovy_listek.create')">
            {{ __('Vytvořit') }}
        </x-nav-link>
        <div class="flex flex-col justify-center items-center md:flex-row">
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
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-200">
            <thead>
                <tr>
                    <th class="py-2 px-4 border-b border-gray-200 bg-gray-100 text-left text-sm font-semibold text-gray-600">Název</th>
                    <th class="py-2 px-4 border-b border-gray-200 bg-gray-100 text-left text-sm font-semibold text-gray-600">Kategorie</th>
                    <th class="py-2 px-4 border-b border-gray-200 bg-gray-100 text-left text-sm font-semibold text-gray-600">Popis</th>
                    <th class="py-2 px-4 border-b border-gray-200 bg-gray-100 text-left text-sm font-semibold text-gray-600">Cena</th>
                    <th class="py-2 px-4 border-b border-gray-200 bg-gray-100 text-left text-sm font-semibold text-gray-600">Akce</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($napoje as $radek)
                <tr class="hover:bg-gray-50">
                    <td class="py-2 px-4 border-b border-gray-200 min-w-[200px]">{{ $radek->nazev }}</td>
                    <td class="py-2 px-4 border-b border-gray-200 min-w-[200px]">{{ $radek->kategorie->nazev }}</td>
                    <td class="py-2 px-4 border-b border-gray-200 max-w-[350px] min-w-[250px]">{{ $radek->popis }}</td>
                    <td class="py-2 px-4 border-b border-gray-200 min-w-[100px]">{{ $radek->cena }} Kč</td>
                    <td class="py-2 px-4 border-b border-gray-200 min-w-[235px]">
                        <a href="{{ route('napojovy_listek.edit', $radek->id) }}" class="bg-yellow-300 text-sm py-2 px-4 rounded inline-block">
                            Upravit
                        </a>
                        <form action="{{ route('napojovy_listek.destroy', $radek->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="{{ $radek->aktivni ? 'bg-red-500 hover:bg-red-700' : 'bg-green-500 hover:bg-green-700' }} ml-2 text-sm text-white py-2 px-4 rounded inline-block">
                                {{ $radek->aktivni ? 'Deaktivovat' : 'Aktivovat' }}
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>