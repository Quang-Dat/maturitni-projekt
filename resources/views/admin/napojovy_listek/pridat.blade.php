<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Přidat nový nápoj') }}
        </h2>
    </x-slot>

    <!-- Zobrazení chybových zpráv -->
    @if ($errors->any())
    <div class="bg-red-100 text-red-700 p-4 rounded mb-4">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <!-- Flash zprávy o úspěchu nebo chybě -->
    @if (session('success'))
    <div class="bg-green-100 text-green-700 p-4 rounded mb-4">
        {{ session('success') }}
    </div>
    @elseif (session('error'))
    <div class="bg-red-100 text-red-700 p-4 rounded mb-4">
        {{ session('error') }}
    </div>
    @endif

    <!-- Formulář pro přidání produktu -->
    <form action="{{ route('napojovy_listek.store') }}" method="POST" class="max-w-lg mt-8 mx-auto bg-white p-6 rounded shadow-md">
        @csrf <!-- Ochrana proti CSRF útokům -->

        <div class="mb-4">
            <label for="nazev" class="block text-gray-700">Název nápoje:</label>
            <input type="text" name="nazev" id="nazev" value="{{ old('nazev') }}" required class="w-full mt-1 p-2 border border-gray-300 rounded">
        </div>

        <div class="mb-4">
            <label for="popis" class="block text-gray-700">Popis nápoje:</label>
            <textarea name="popis" id="popis" required class="w-full mt-1 p-2 border border-gray-300 rounded">{{ old('popis') }}</textarea>
        </div>

        <div class="mb-4">
            <label for="cena" class="block text-gray-700">Cena produktu (v Kč):</label>
            <input type="number" name="cena" id="cena" min="0" step="0.01" value="{{ old('cena') }}" required class="w-full mt-1 p-2 border border-gray-300 rounded">
        </div>

        <div class="mb-4">
            <label for="kategorie" class="block text-gray-700">Kategorie:</label>
            <input type="text" name="kategorie" id="kategorie" value="{{ old('kategorie') }}" required class="w-full mt-1 p-2 border border-gray-300 rounded">
        </div>

        <div class="flex justify-end">
            <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">
                Přidat do nápojového lístku
            </button>
        </div>
    </form>
</x-app-layout>