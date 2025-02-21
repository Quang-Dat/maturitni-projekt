<?php

namespace App\Http\Controllers;

use App\Models\StaleMenu;
use Illuminate\Http\Request;

class KosikController extends Controller
{
    public function produkty(Request $request)
    {
        $menu_kategorie = StaleMenu::with('kategorie')
            ->where('aktivni', 1)
            ->get()
            ->pluck('kategorie')
            ->unique();

        $menu = StaleMenu::where('aktivni', 1)->get();

        return view(view: 'produkty', data: ['menu_kategorie' => $menu_kategorie, 'menu' => $menu,]);
    }


    public function vypsatKosik(Request $request)
    {
        return view('kosik');
    }
}
