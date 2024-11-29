<?php

namespace App\Http\Controllers;

use App\Models\NapojovyListek;
use App\Models\Recenze;
use App\Models\StaleMenu;
use Illuminate\Http\Request;

class Menu_A_NapojeController extends Controller
{
    public function menu_a_napoje()
    {
        $menu_kategorie = StaleMenu::with('kategorie')
            ->where('aktivni', 1)
            ->get()
            ->pluck('kategorie')
            ->unique();

        $menu = StaleMenu::where('aktivni', 1)->get();

        $piti_kategorie = NapojovyListek::with('kategorie')
            ->where('aktivni', 1)
            ->get()
            ->pluck('kategorie')
            ->unique();

        $piti_data = NapojovyListek::where('aktivni', 1)->get();

        $recenze = Recenze::with('user')->latest()->take(5)->get();

        return view("welcome", ['menu_kategorie' => $menu_kategorie, 'menu' => $menu, 'piti_kategorie' => $piti_kategorie, 'piti_data' => $piti_data, 'recenze' => $recenze]);
    }
}
