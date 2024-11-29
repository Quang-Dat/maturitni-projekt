<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Upravit jídlo') }}
        </h2>
    </x-slot>
    <div class="container">

        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif

        @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
        @endif

        <form action="{{ route('stale_menu.update', $menu->id) }}" method="POST">
            @csrf
            @method('PATCH') <!-- nebo @method('PUT') -->

            <div class="form-group">
                <label for="nazev">Název</label>
                <input type="text" name="nazev" id="nazev" class="form-control" value="{{ old('nazev', $menu->nazev) }}" required>
            </div>

            <div class="form-group">
                <label for="popis">Popis</label>
                <textarea name="popis" id="popis" class="form-control" required>{{ old('popis', $menu->popis) }}</textarea>
            </div>

            <div class="form-group">
                <label for="cena">Cena</label>
                <input type="number" name="cena" id="cena" class="form-control" value="{{ old('cena', $menu->cena) }}" required>
            </div>

            <div class="form-group">
                <label for="kategorie">Kategorie</label>
                <input type="text" name="kategorie" id="kategorie" class="form-control" value="{{ old('kategorie', $menu->kategorie->nazev ?? '') }}" required>
            </div>

            <button type="submit" class="btn btn-primary">Uložit změny</button>
        </form>
    </div>
</x-app-layout>