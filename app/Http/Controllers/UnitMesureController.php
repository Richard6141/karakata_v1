<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\UnitOfMeasure;
use Illuminate\Support\Facades\Auth;

class UnitMesureController extends Controller
{
     public function index()
    {
        return view('unitemesures.index', [
            'unites' => UnitOfMeasure::all(),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'labels' => 'required|string',
        ]);

        $label = ucfirst(strtolower($request->labels));

        $Unite= UnitOfMeasure::where('label', $label)->first();
        
        if (!blank($Unite)) {

            $message = "Cette unité de mesure existe déjà !";
            return redirect()->route('unites.index')->with('error', "$message");
        }


        $label = preg_replace('/\s\s+/', ' ', $label);

        $validator = UnitOfMeasure::create([
            'id' => Str::uuid(),
            'label' => $label,
            'created_by' => Auth::user()->id,

        ]);

        $message = "Unité de mesure enregistré !";
        return redirect()->route('unites.index')->with('success', "$message");
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'label' => 'required|string|unique:unit_of_measures,label,' . $id,
            ]);

            $labels = ucfirst(strtolower($request->labels));


            $labels = preg_replace('/\s\s+/', ' ', $labels);
            $validator = UnitOfMeasure::where('id', $id)->update([
                'label' => $labels,
                'updatedBy' => Auth::user()->id,
            ]);

            $message = "Unité de mesure modifié !";
            return redirect()->route('unites.index')->with('success', "$message");
        } catch (\Throwable $th) {
            $message = "Unité de mesure non modifié !";
            return redirect()->route('unites.index')->with('error', "$message");
        }

    }

    public function delete ($id)
    {

        $unite = UnitOfMeasure::where('id', $id)->first();
        if (!blank($unite)) {
            # code...
            $product = Product::where('uniteofmesure_id', $unite->id)->first();
            if (!blank($product)) {
                return back()->with('warning', "Impossible ! Cette unité est déjà utilisée");
            } else {
                $unite->delete();

                return redirect()->route('unites.index')->with('success', "Unité de mesure supprimée !");
            }
        }else {

            $message = "Erreur d'ID !";
                return redirect()->route('unites.index')->with('error', "$message");
        }
    }
}
