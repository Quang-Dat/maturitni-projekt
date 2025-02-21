<?php

namespace App\Http\Controllers;

use App\Models\Kategorie;
use App\Models\StaleMenu;
use Illuminate\Http\Request;

class StaleMenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $menu = StaleMenu::all();

        $status = $request->query('status', 'all');

        if ($status === 'active') {
            $jidla = StaleMenu::where('aktivni', 1)->get();
        } elseif ($status === 'inactive') {
            $jidla = StaleMenu::where('aktivni', 0)->get();
        } else {
            $jidla = StaleMenu::all();
        }

        return view('admin.stale_menu.vsechny', compact('jidla', 'status'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kategorie = Kategorie::all();

        return view("admin.stale_menu.pridat", compact('kategorie'));
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
                attributes: ["nazev" => $nazevKategorie],
            );

            $kategorie_id = $kategorie->id;

            $produkt = StaleMenu::create([
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
        $menu = StaleMenu::with('kategorie')->find($id);

        return view("admin.stale_menu.upravit", ['menu' => $menu]);
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

            $produkt = StaleMenu::findOrFail($id);

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
            $menu = StaleMenu::findOrFail($id);

            $menu->aktivni = !$menu->aktivni;
            $menu->save();

            session()->flash("success", "Stav menu byl úspěšně změněn.");
        } catch (\Exception $e) {
            session()->flash("error", "Došlo k chybě při změně stavu menu: " . $e->getMessage());
        }

        return redirect()->back();
    }
}
