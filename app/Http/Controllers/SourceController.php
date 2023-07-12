<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Source;
use App\Models\Commande;
use App\Models\Commandes;
use Illuminate\View\View;
use App\Models\Composants;
use App\Models\Suggestion;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Psy\CodeCleaner\ReturnTypePass;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

class SourceController extends Controller
{
    public function index(): View
    {
        $Source = Source::all();
        return view('sources.index', [
            'Source' => $Source,
        ]);
    }

    public function store(Request $request): RedirectResponse
    {

        $request->validate([
            'label' => 'required|string',
        ]);

        if (is_string($request->label)) {
            $label = ucfirst(strtolower($request->label));
            $Source = Source::where('label', $label)->first();
            if (!blank($Source)) {

                $message = "Cette source existe déjà !";
                return redirect()->route('sources.index')->with('error', "$message");
            }

            $label = preg_replace('/\s\s+/', ' ', $label);

            Source::create([
                'id' => Str::uuid(),
                'label' => preg_replace('/\s\s+/', ' ', ucfirst(strtolower($request->label))),
                'created_by' => Auth::user()->id ?? null,
            ]);

            $message = "Source enregistrée !";
            return redirect()->route('sources.index')->with('success', "$message");
        }
        return back()->with('error', 'Impossible d\'enregistrer');
    }




    public function updatesources(Request $request, string $id): RedirectResponse
    {
        try {
            $request->validate([
                'label' => 'required|string|unique:sources,label,' . $id,
            ]);

            if (is_string($request->label)) {
                $label = ucfirst(strtolower($request->label));
                $label = preg_replace('/\s\s+/', ' ', $label);
                $validator = Source::where('id', $id)->update([
                    'label' => $label,
                    'updated_by' => Auth::user()->id ?? null,
                ]);
                $message = "Source modifiée !";
                return redirect()->route('sources.index')->with('success', "$message");
            } return back()->with('error', 'Erreur lors de la modification');
        } catch (\Throwable $th) {
            $message = "Cette source existe déjà !";
            return redirect()->route('sources.index')->with('error', "$message");
        }
    }



    public function destroy(string $id): RedirectResponse
    {

        /** @var Source */
        $Source = Source::where('id', $id)->first();
        if (!blank($Source)) {
            $suggestion = Suggestion::where('sources_id', $Source->id ?? null)->first();
            $commande = Order::where('source_id', $Source->id ?? null)->first();
            if (!blank($suggestion)) {
                $message = "Impossible de supprimé cette source!";
                return redirect()->route('sources.index')->with('error', "$message");
            } 
            elseif (!blank($commande)) {
                $message = "Cette source a déjà été utilisée !";
                return redirect()->route('sources.index')->with('error', "$message");
            } 
            else {
                $Source->delete();
                $message = "Source supprimée !";
                return redirect()->route('sources.index')->with('success', "$message");
            }
        } else {

            $message = "Erreur d'ID !";
            return redirect()->route('sources.index')->with('error', "$message");
        }
    }
}
