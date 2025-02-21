<?php

namespace App\Http\Controllers;

use App\Models\Kategorie;
use App\Models\NapojovyListek;
use Illuminate\Http\Request;

class NapojovyListekController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $status = $request->query('status', 'all');

        if ($status === 'active') {
            $napoje = NapojovyListek::where('aktivni', 1)->get();
        } elseif ($status === 'inactive') {
            $napoje = NapojovyListek::where('aktivni', 0)->get();
        } else {
            $napoje = NapojovyListek::all();
        }

        return view('admin.napojovy_listek.vsechny', compact('napoje', 'status'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kategorie = Kategorie::all();
        return view("admin.napojovy_listek.pridat", compact('kategorie'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "nazev" => "required|string|max:255",
            "popis" => "required|string",
            "cena" => "required|numeric|min:0",
            "kategorie" => "required|string",
        ]);

        try {
            $nazevKategorie = $request->input("kategorie");

            $kategorie = Kategorie::firstOrCreate(
                ["nazev" => $nazevKategorie],
            );

            $kategorie_id = $kategorie->id;

            $produkt = NapojovyListek::create([
                "nazev" => $request->input("nazev"),
                "popis" => $request->input("popis"),
                "cena" => $request->input("cena"),
                "kategorie_id" => $kategorie_id,
                "user_id" => $request->user()->id,
            ]);

            session()->flash("success", "Produkt byl úspěšně uložen.");
        } catch (\Exception $e) {
            session()->flash("error", "Došlo k chybě při ukládání produktu: " . $e->getMessage());
        }

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $napoje = NapojovyListek::with('kategorie')->find($id);
        $kategorie = Kategorie::all();

        return view("admin.napojovy_listek.upravit", ['napoje' => $napoje, 'kategorie' => $kategorie]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            "nazev" => "required|string|max:255",
            "popis" => "required|string",
            "cena" => "required|numeric|min:0",
            "kategorie" => "required|string",
        ]);

        try {
            $nazevKategorie = $request->input("kategorie");

            $kategorie = Kategorie::firstOrCreate(
                ["nazev" => $nazevKategorie],
            );

            $kategorie_id = $kategorie->id;

            $produkt = NapojovyListek::findOrFail($id);

            $produkt->update([
                "nazev" => $request->input("nazev"),
                "popis" => $request->input("popis"),
                "cena" => $request->input("cena"),
                "kategorie_id" => $kategorie_id,
                "user_id" => $request->user()->id,
            ]);

            session()->flash("success", "Produkt byl úspěšně aktualizován.");
        } catch (\Exception $e) {
            session()->flash("error", "Došlo k chybě při aktualizaci produktu: " . $e->getMessage());
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $napoje = NapojovyListek::findOrFail($id);

            $napoje->aktivni = !$napoje->aktivni;
            $napoje->save();

            session()->flash("success", "Stav napoje byl úspěšně změněn.");
        } catch (\Exception $e) {
            session()->flash("error", "Došlo k chybě při změně stavu napoje: " . $e->getMessage());
        }

        return redirect()->back();
    }
}
