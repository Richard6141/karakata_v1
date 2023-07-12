<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Product;
use App\Models\Operation;
use App\Models\Operations;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\OperationType;
use App\Models\UnitOfMeasure;
use App\Models\TypeOfOperations;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

class ProductController extends Controller
{

    public function index() : View
    {
        
        $produits = Product::all();
        return view('gestionstock.products.index', [
            'produits' => $produits
        ]);
    }


    public function store1() : View
    {
        // $produits = Product::all();
        $unites = UnitOfMeasure::all();
        return view('gestionstock.products.store1', [
            'date' => date('Y-m-d'),
            'unite' => $unites
        ]);
    }

    public function ShowProduct(string $id) : View
    {
        $id = htmlspecialchars(trim(strval($id)));
        /** @var Product */
        $produit = Product::find($id);
        $operations = Operation::where('product_id', $produit->id)->orderBy("created_at")->get();
        $entree = OperationType::where('label', 'Entrée')->first();
        $sortie = OperationType::where('label', 'Sortie')->first();
        $inventaire = OperationType::where('label', 'Inventaire')->first();
        // dd($entree);
        return view('gestionstock.products.show', [
            'produit' => $produit,
            'operations' => $operations,
            'entree' => $entree,
            'sortie' => $sortie,
            'inventaire' => $inventaire
        ]);
    }

    public function Storeproduct(Request $request) : RedirectResponse
    {

        $request->validate([
            'uniteofmesure_id' => 'required|string',
            'label' => 'required|string|unique:products',
            'safetyStock' => 'required|integer|min:1',
        ]);

        try {
            if(Auth::user() instanceof User){
                 $products = Product::create([
                'id' => Str::uuid(),
                'uniteofmesure_id' => $request->uniteofmesure_id,
                'label' => $request->label,
                'safety_stock' => $request->safetyStock,
                'created_by' => Auth::user()->name . " " .Auth::user()->firstname,
            ]);
            return redirect()->route('produits.index')->with('success', "Produit enrégistré avec succès");

            }
            abort(401);
        
        } catch (\Throwable $th) {
            return back()->with('Erreur', $th->getMessage());
        }
    }

    // Update a product identified by id

    public function updateProduct(string $id) : View
    {
        // $domaine1 = Domaine::where('label', 'Cuisine')->first();
        $produit = Product::find($id);
        $unite = UnitOfMeasure::all();

        return view('gestionstock.products.updateproduct', [
            'produit' => $produit,
            'unite' => $unite,
        ]);
    }


    public function updateProductSubmissions(Request $request, string $id) : RedirectResponse
    {
        $produit = Product::find($id);

        $request->validate([
            'uniteofmesure_id' => 'required|string',
            'label' => 'required|string',
            'safetyStock' => 'required|integer',
        ]);
        try {
            if($produit instanceof Product && Auth::user() instanceof User){
                $produit->uniteofmesure_id = strval($request->uniteofmesure_id);
            $produit->label = strval($request->label);
            $produit->safety_stock = strval($request->safetyStock);
            $produit->updated_by = Auth::user()->name . " " .Auth::user()->firstname;
            $produit->save();
            return redirect()->route('produits.index')->with('success', "Produit modifié avec succès");
            
            }
            abort(401);
            
        } catch (\Throwable $th) {
            return back()->with('Erreur', $th->getMessage());
        }
    }

    // Delete product identified by id

    public function DestroyProduct(string $id) : RedirectResponse
    {
        // dd('delete');
        $produit = Product::find($id);
        if(is_null($produit)){
            abort(404);
        }
        try {
        $operations = Operation::where('product_id', $produit->id)->first();
            if(!blank($operations)){
                return back()->with('error', "Produit en cours d'utilisation");
            }else{
               
            $produit->delete();
            return redirect()->route('produits.index')->with('success', "Produit " . $produit->label . " supprimé avec succès");
            }
        } catch (\Throwable $th) {
            return back()->with('Erreur', $th->getMessage());
        }
    }

   
}
