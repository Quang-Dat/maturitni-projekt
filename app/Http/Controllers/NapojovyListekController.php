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
        // Získání hodnoty z query parametru 'status'
        $status = $request->query('status', 'all'); // Výchozí hodnota je 'all'

        // Na základě parametru 'status' filtrujeme nápoje
        if ($status === 'active') {
            $napoje = NapojovyListek::where('aktivni', 1)->get();
        } elseif ($status === 'inactive') {
            $napoje = NapojovyListek::where('aktivni', 0)->get();
        } else {
            $napoje = NapojovyListek::all(); // Zobrazí všechny nápoje
        }

        // Předání dat do šablony
        return view('admin.napojovy_listek.vsechny', compact('napoje', 'status'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("admin.napojovy_listek.pridat");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validace vstupních dat
        $request->validate([
            "nazev" => "required|string|max:255",
            "popis" => "required|string",
            "cena" => "required|numeric|min:0",
            "kategorie" => "required|string", // Kategorie by měla být text
        ]);

        try {
            // Získání názvu kategorie z formuláře
            $nazevKategorie = $request->input("kategorie");

            // Najdi nebo vytvoř kategorii podle názvu
            $kategorie = Kategorie::firstOrCreate(
                ["nazev" => $nazevKategorie],  // Hledáme podle názvu
            );

            // Získání ID kategorie
            $kategorie_id = $kategorie->id;

            // Vytvoření a uložení nového produktu
            $produkt = NapojovyListek::create([
                "nazev" => $request->input("nazev"),
                "popis" => $request->input("popis"),
                "cena" => $request->input("cena"),
                "kategorie_id" => $kategorie_id, // Nastavení kategorie
                "user_id" => $request->user()->id,
            ]);

            // Uložení flash zprávy o úspěchu
            session()->flash("success", "Produkt byl úspěšně uložen.");
        } catch (\Exception $e) {
            // Uložení flash zprávy o neúspěchu
            session()->flash("error", "Došlo k chybě při ukládání produktu: " . $e->getMessage());
        }

        // Přesměrování zpět s flash zprávou
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
        // Example: Fetch a model instance by ID
        $napoje = NapojovyListek::with('kategorie')->find($id);

        // Pass the item to the view
        return view("admin.napojovy_listek.upravit", ['napoje' => $napoje]);
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
            "kategorie" => "required|string", // Kategorie by měla být text
        ]);

        try {
            // Získání názvu kategorie z formuláře
            $nazevKategorie = $request->input("kategorie");

            // Najdi nebo vytvoř kategorii podle názvu
            $kategorie = Kategorie::firstOrCreate(
                ["nazev" => $nazevKategorie],  // Hledáme podle názvu
            );

            // Získání ID kategorie
            $kategorie_id = $kategorie->id;

            // Najdi existující produkt
            $produkt = NapojovyListek::findOrFail($id);

            // Aktualizace existujícího produktu
            $produkt->update([
                "nazev" => $request->input("nazev"),
                "popis" => $request->input("popis"),
                "cena" => $request->input("cena"),
                "kategorie_id" => $kategorie_id, // Nastavení kategorie
                "user_id" => $request->user()->id,
            ]);

            // Uložení flash zprávy o úspěchu
            session()->flash("success", "Produkt byl úspěšně aktualizován.");
        } catch (\Exception $e) {
            // Uložení flash zprávy o neúspěchu
            session()->flash("error", "Došlo k chybě při aktualizaci produktu: " . $e->getMessage());
        }

        // Přesměrování zpět s flash zprávou
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            // Najdi existující produkt
            $napoje = NapojovyListek::findOrFail($id);

            // Přepni stav aktivní/neaktivní
            $napoje->aktivni = !$napoje->aktivni;
            $napoje->save();

            // Uložení flash zprávy o úspěchu
            session()->flash("success", "Stav napoje byl úspěšně změněn.");
        } catch (\Exception $e) {
            // Uložení flash zprávy o neúspěchu
            session()->flash("error", "Došlo k chybě při změně stavu napoje: " . $e->getMessage());
        }

        // Přesměrování zpět s flash zprávou
        return redirect()->back();
    }
}
