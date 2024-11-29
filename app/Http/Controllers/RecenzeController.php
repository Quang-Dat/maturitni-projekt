<?php

namespace App\Http\Controllers;

use App\Models\Recenze;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RecenzeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() {}

    public function create()
    {
        return view('recenze');
    }

    public function store(Request $request)
    {
        try {
            $existingReview = Recenze::where('user_id', Auth::id())->first();
            if ($existingReview) {
                return redirect()->route('recenze')->with('error', 'Již jste vytvořili recenzi.');
            }

            $request->validate([
                'recenze' => 'required|string',
                'hodnoceni' => 'required|integer|min:1|max:5',
            ]);

            Recenze::create([
                'recenze' => $request->recenze,
                'hodnoceni' => $request->hodnoceni,
                'user_id' => Auth::id(),
            ]);

            // Uložení flash zprávy o úspěchu
            session()->flash("success", "Recenze byla úspěšně uložena.");
        } catch (\Exception $e) {
            // Uložení flash zprávy o neúspěchu
            session()->flash("error", "Došlo k chybě při ukládání recenze: " . $e->getMessage());
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
