<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Mail;
use App\Mail\KontaktniEmail;
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

    public function poslatEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'predmet' => 'required|min:3',
            'zprava' => 'required|min:10'
        ], [
            'email.required' => 'Email je povinný',
            'email.email' => 'Neplatný formát emailu',
            'predmet.required' => 'Předmět je povinný',
            'predmet.min' => 'Předmět musí mít alespoň 3 znaky',
            'zprava.required' => 'Zpráva je povinná',
            'zprava.min' => 'Zpráva musí mít alespoň 10 znaků'
        ]);

        try {
            Mail::to('datlequan@seznam.cz')->send(new KontaktniEmail($request->all()));

            return redirect()->back()->with('success', 'Email byl úspěšně odeslán!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Došlo k chybě při odesílání emailu.')->withInput();
        }
    }
}
