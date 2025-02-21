<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StatistikyController extends Controller
{
    public function jedna(Request $request)
    {
        $pocatecniDatum = $request->input('pocatecni_datum');
        $koncoveDatum = $request->input('koncove_datum');

        $celkoveSoucty = DB::table('prod_v_obj')
            ->join('objednavky', 'prod_v_obj.objednavky_id', '=', 'objednavky.id')
            ->join('stale_menu', 'prod_v_obj.stale_menu_id', '=', 'stale_menu.id')
            ->when($pocatecniDatum, function ($query, $pocatecniDatum) {
                return $query->whereDate('objednavky.created_at', '>=', $pocatecniDatum);
            })
            ->when($koncoveDatum, function ($query, $koncoveDatum) {
                return $query->whereDate('objednavky.created_at', '<=', $koncoveDatum);
            })
            ->selectRaw('
            SUM(prod_v_obj.pocet) as celkove_mnozstvi,
            SUM(prod_v_obj.cena * prod_v_obj.pocet) as celkove_trzby,
            COUNT(DISTINCT objednavky.id) as celkem_objednavek
        ')
            ->first();

        $statistikyProduktu = DB::table('prod_v_obj')
            ->join('objednavky', 'prod_v_obj.objednavky_id', '=', 'objednavky.id')
            ->join('stale_menu', 'prod_v_obj.stale_menu_id', '=', 'stale_menu.id')
            ->when($pocatecniDatum, function ($query, $pocatecniDatum) {
                return $query->whereDate('objednavky.created_at', '>=', $pocatecniDatum);
            })
            ->when($koncoveDatum, function ($query, $koncoveDatum) {
                return $query->whereDate('objednavky.created_at', '<=', $koncoveDatum);
            })
            ->selectRaw('
            stale_menu.nazev as nazev_produktu,
            SUM(prod_v_obj.pocet) as celkem_prodano,
            SUM(prod_v_obj.cena * prod_v_obj.pocet) as celkove_trzby,
            COUNT(DISTINCT objednavky.id) as pocet_objednavek
        ')
            ->groupBy('stale_menu.nazev')
            ->orderByDesc('celkem_prodano')
            ->get();

        return view('admin.stats.statJedna', [
            'celkoveSoucty' => (array) $celkoveSoucty,
            'statistikyProduktu' => $statistikyProduktu,
        ]);
    }
}
