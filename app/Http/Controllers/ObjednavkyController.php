<?php

namespace App\Http\Controllers;

use App\Models\Objednavky;
use App\Models\Prod_V_Obj;
use App\Models\StaleMenu;
use App\Models\TypDopravy;
use App\Models\TypPlatby;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\View as FacadesView;
use Spatie\Browsershot\Browsershot;

class ObjednavkyController extends Controller
{

    public function createPDF($id)
    {
        try {
            $objednavka = Objednavky::with("typ_platby")->find($id);

            if ($objednavka->user_id != Auth::id()) {
                return redirect()->route("index")->with('error', 'Došlo k chybě');
            }

            $produkty = Prod_V_Obj::where("objednavky_id", $id)->with("menu_id")->get();
            $cena = 0;

            foreach ($produkty as $produkt) {
                $cena = $cena + $produkt->cena * $produkt->pocet;
            };

            Log::info($cena);


            $data = ["objednavka" => $objednavka, "produkty" => $produkty, "cena" => $cena];
            $html = FacadesView::make('pdf.objednavkaPDF', $data)->render();

            Browsershot::html($html)
                ->setNodeBinary('C:\Program Files\nodejs\node.exe')
                ->setNpmBinary('C:\Program Files\nodejs\npm.cmd')
                ->save('objednavka.pdf');

            return response()->download('objednavka.pdf');
        } catch (\Exception $e) {
            // Uložení flash zprávy o neúspěchu
            Log::error('PDF generation error: ' . $e->getMessage());

            return redirect()->back()->with('error', 'Došlo k chybě');
        }
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $typ_platby = TypPlatby::all();
        $typ_dopravy = TypDopravy::all();
        return view('kosik', compact('typ_platby', 'typ_dopravy'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $req = $request->validate([
                'jmeno' => 'required|string',
                'prijmeni' => 'required|string',
                'email' => 'required|email',
                'telefon' => [
                    'required',
                    'string',
                    'regex:/^(\+420\s?\d{3}\s?\d{3}\s?\d{3}|\d{3}\s?\d{3}\s?\d{3})$/'
                ],
                'ulice' => 'required|string',
                'cp' => 'required|integer',
                'psc' => [
                    'required',
                    'string',
                    'regex:/^\d{3}\s?\d{2}$/'
                ],
                'mesto' => 'required|string',
                'typ_platby' => 'required|integer',
                'typ_dopravy' => 'required|integer',
            ]);

            $obj = Objednavky::create([
                'jmeno' => $request->jmeno,
                'prijmeni' => $request->prijmeni,
                'email' => $request->email,
                'telefon' => $request->telefon,
                'ulice' => $request->ulice,
                'cp' => $request->cp,
                'psc' => $request->psc,
                'mesto' => $request->mesto,
                'typ_platby_id' => $request->typ_platby,
                'typ_dopravy_id' => $request->typ_dopravy,
                'user_id' => Auth::id(),
            ]);

            $idObjednavky = $obj->id;
            $pocet = $request->input('pocet');
            $ids = $request->input('id');

            foreach ($pocet as $id => $quantity) {
                $product = StaleMenu::find($id);

                if ($product) {
                    Prod_V_Obj::create([
                        'pocet' => $quantity,
                        'cena' => $product->cena, // Ensure 'price' is a column in your StaleMenu table
                        'stale_menu_id' => $id,
                        'objednavky_id' => $idObjednavky,
                    ]);
                }
            }


            return view("uspech", ["id" => $idObjednavky])->with('success', 'Vaše objednávka byla úspěšně odeslána');
        } catch (\Exception $e) {
            // Uložení flash zprávy o neúspěchu
            return redirect()->back()->with('error', 'Došlo k chybě při odeslání objednávky');
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id) {}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
