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

    // public function pridatDoKosiku(Request $request)
    // {
    //     $jidlo_id = $request->input('id');
    //     $pocet = $request->input('pocet');

    //     // Retrieve the cart from the session or create a new one
    //     $kosik = session()->get('kosik', []);

    //     // Check if the product is already in the cart
    //     if (isset($kosik[$jidlo_id])) {
    //         // Increment the quantity
    //         $kosik[$jidlo_id] += $pocet;
    //     } else {
    //         // Add the product to the cart
    //         $kosik[$jidlo_id] = $pocet;
    //     }

    //     // Store the updated cart in the session
    //     session()->put('kosik', $kosik);

    //     // Redirect back with a success message
    //     return redirect()->back()->with('success', 'Produkt byl přidán do košíku');
    // }

    public function vypsatKosik(Request $request)
    {
        return view('kosik');
    }
}
