<?php

namespace App\Http\Controllers;

use stdClass;
use Throwable;
use App\Models\User;
use App\Models\Product;
use App\Models\Operation;
use App\Models\Operations;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\OperationType;
use App\Mail\AlertProductMail;
use App\Jobs\AlertProductMailJob;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\RedirectResponse;

class OperationsController extends Controller
{
    public function index_entree(): View
    {
        $typeOfOperation = OperationType::where('label', 'Entrée')->pluck('id');
        $typeOfOperation = $typeOfOperation->first();
        $typeOfOperation_label = OperationType::where('label', 'Entrée')->pluck('label');
        $typeOfOperation_label = $typeOfOperation_label->first();
        $operations = Operation::where('operation_type_id', $typeOfOperation)->orderBy('created_at')->get();
        $listeTypeOfOperation = OperationType::all();
        $listeTypeOfOperation = $listeTypeOfOperation->pluck('label');
        return view('gestionstock.operations.index', [
            'operations' => $operations,
            'typeOfOperation_label' => $typeOfOperation_label,
            'listeTypeOfOperation' => $listeTypeOfOperation
        ]);
    }

    public function index_sortie(): View
    {
        $typeOfOperation = OperationType::where('label', 'Sortie')->pluck('id');
        $typeOfOperation = $typeOfOperation->first();
        $typeOfOperation_label = OperationType::where('label', 'Sortie')->pluck('label');
        $typeOfOperation_label = $typeOfOperation_label->first();
        $operations = Operation::where('operation_type_id', $typeOfOperation)->orderBy('created_at')->get();
        $listeTypeOfOperation = OperationType::all();
        $listeTypeOfOperation = $listeTypeOfOperation->pluck('label');
        return view('gestionstock.operations.index', [
            'operations' => $operations,
            'typeOfOperation_label' => $typeOfOperation_label,
            'listeTypeOfOperation' => $listeTypeOfOperation
        ]);
    }

    public function index_inventaire(): View
    {
        $typeOfOperation = OperationType::where('label', 'Inventaire')->pluck('id');
        $typeOfOperation = $typeOfOperation->first();
        $typeOfOperation_label = OperationType::where('label', 'Inventaire')->pluck('label');
        $typeOfOperation_label = $typeOfOperation_label->first();
        $operations = Operation::where('operation_type_id', $typeOfOperation)->orderBy('created_at')->get();
        $listeTypeOfOperation = OperationType::all();
        $listeTypeOfOperation = $listeTypeOfOperation->pluck('label');
        return view('gestionstock.operations.index', [
            'operations' => $operations,
            'typeOfOperation_label' => $typeOfOperation_label,
            'listeTypeOfOperation' => $listeTypeOfOperation
        ]);
    }

    public function create_entree(): View
    {
        $products = Product::all();
        $typeOfOperation = OperationType::where('label', 'Entrée')->first();
        return view('gestionstock.operations.form', [
            'products' => $products,
            'typeOfOperation' => $typeOfOperation,
            'date' => date('Y-m-d')
        ]);
    }

    public function create_inventaire(): View
    {
        $products = Product::all();
        $typeOfOperation = OperationType::where('label', 'Inventaire')->first();
        return view('gestionstock.operations.form', [
            'products' => $products,
            'typeOfOperation' => $typeOfOperation,
            'date' => date('Y-m-d')
        ]);
    }

    public function create_sortie(): View
    {
        $products = Product::all();
        $typeOfOperation = OperationType::where('label', 'Sortie')->first();
        // dd($typeOfOperation);
        return view('gestionstock.operations.form', [
            'products' => $products,
            'typeOfOperation' => $typeOfOperation,
            'date' => date('Y-m-d')
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'product_id' => 'required',
            'operation_type_id' => 'required',
            'quantity' => 'required|min:1|not_in:0',
            'label' => 'required',
            'observation' => 'required',
            'dateOfOperation' => 'required',
        ]);
        try {
            /** @var Product */
            $productToChange = Product::where('id', $request->product_id)->first();
            if ($productToChange instanceof Product) {
                /** @var int $fieldToChange */
                $fieldToChange = $productToChange->available_stock;
                /** @var int $newValueOfenter */
                $newValueOfenter = $fieldToChange + $request->quantity;
                /** @var int $newValueOfwithwraw */
                $newValueOfwithwraw = $fieldToChange - $request->quantity;
                $typeOfOperation = OperationType::where('id', $request->operation_type_id)->pluck('label')[0];
                $gestionnaires = (object) User::whereHas(
                    'roles',
                    function ($q) {
                        $q->where('name', 'GESTIONNAIRE_DE_STOCK');
                    }
                );
                $gestionnaires = $gestionnaires->where('status', true);
                $gestionnaires = $gestionnaires->pluck('email');
                $emails = [];
                foreach ($gestionnaires as $key => $value) {
                    array_push($emails, $value);
                }
                if ($request->quantity > 0) {
                    if (is_null($request->price) || $request->price > 0) {
                        if ($request->dateOfOperation <= date('Y-m-d')) {
                            if ($typeOfOperation == 'Entrée') {

                                $operation = Operation::create([
                                    'id' => Str::uuid(),
                                    'product_id' => $request->product_id,
                                    'operation_type_id' => $request->operation_type_id,
                                    'quantity' => $request->quantity,
                                    'price' => $request->price,
                                    'label' => $request->label,
                                    'theoricquantity' => $newValueOfenter,
                                    'observation' => $request->observation,
                                    'date_operation' => $request->dateOfOperation,
                                    'created_by' => Auth::user()->id ?? null
                                ]);

                                $productToChange->available_stock = strval($newValueOfenter);
                                $productToChange->save();
                                if ($productToChange->available_stock <= $productToChange->safety_stock) {
                                    $data = [
                                        'title' => 'Avertissement',
                                        'product_name' => $productToChange->label ?? null,
                                        'product_safety_stock' => $productToChange->safety_stock ?? null,
                                        'product_available_stock' => $productToChange->available_stock ?? null,
                                    ];
                                    AlertProductMailJob::dispatch($data);

                                    return redirect()->route('entrees')->with('success', 'Ajout effectué avec succes');
                                }
                                return redirect()->route('entrees')->with('success', 'Ajout effectué avec succes');
                            } elseif ($typeOfOperation == 'Sortie') {
                                $operation = Operation::create([
                                    'id' => Str::uuid(),
                                    'product_id' => $request->product_id,
                                    'operation_type_id' => $request->operation_type_id,
                                    'quantity' => $request->quantity,
                                    'label' => $request->label,
                                    'theoricquantity' => $newValueOfwithwraw,
                                    'observation' => $request->observation,
                                    'date_operation' => $request->dateOfOperation,
                                    'created_by' => Auth::user()->id ?? null
                                ]);


                                $productToChange->available_stock = strval($newValueOfwithwraw);
                                $productToChange->save();
                                if (($productToChange->available_stock ?? null) <= ($productToChange->safety_stock ?? null)) {
                                    $data = [
                                        'title' => 'Avertissement',
                                        'product_name' => $productToChange->label ?? null,
                                        'product_safety_stock' => $productToChange->safety_stock ?? null,
                                        'product_available_stock' => $productToChange->available_stock ?? null,
                                    ];
                                    AlertProductMailJob::dispatch($data);
                                    return redirect()->route('sorties')->with('success', 'Retrait effectué avec succes');
                                }
                                return redirect()->route('sorties')->with('success', 'Retrait effectué avec succes');
                                // }
                            } elseif ($typeOfOperation == 'Inventaire') {

                                $operation = Operation::create([
                                    'id' => Str::uuid(),
                                    'product_id' => $request->product_id,
                                    'operation_type_id' => $request->operation_type_id,
                                    'quantity' => $request->quantity,
                                    'label' => $request->label,
                                    'theoricquantity' => $request->quantity,
                                    'observation' => $request->observation,
                                    'date_operation' => $request->dateOfOperation,
                                    'created_by' => Auth::user()->id ?? null
                                ]);
                                // if ($productToChange instanceof Product) {
                                $productToChange->available_stock = strval($request->quantity);
                                $productToChange->save();
                                if (($productToChange->available_stock) <= ($productToChange->safety_stock)) {
                                    $data = [
                                        'title' => 'Avertissement',
                                        'product_name' => $productToChange->label ?? null,
                                        'product_safety_stock' => $productToChange->safety_stock ?? null,
                                        'product_available_stock' => $productToChange->available_stock ?? null,
                                    ];
                                    AlertProductMailJob::dispatch($data);

                                    return redirect()->route('inventaires')->with('success', 'Inventaire effectué avec succès');
                                } else {
                                    return redirect()->route('inventaires')->with('success', 'Inventaire effectué avec succès');
                                }
                            } else {
                                return back()->with('error', "Enregistrement échoué !");
                            }
                        } else {
                            return back()->with('error', "Une erreur est intervenue !");
                        }
                    } else {
                        return back()->with('error', "Erreur ! Le prix doit être positif !");
                    }
                } else {
                    return back()->with('error', "Erreur ! La quantité doit être positive !");
                }
            }
        } catch (Throwable $th) {
            return back()->with('error', "Enregistrement échoué !" . $th);
        }
    }

    public function destroy(string $id): RedirectResponse
    {
        $operation = Operation::find($id);
        if (!is_null($operation)) {
            $product = Product::where('id', $operation->product_id ?? null)->first();
            $lastOperations = Operation::where('product_id', $product->id ?? null)->orderBy('created_at', 'DESC')->first();
            if (Auth::user() instanceof User) {
                if (Auth::user()->hasRole('GESTIONNAIRE_DE_STOCK') || Auth::user()->hasRole('ADMINISTRATEUR') || Auth::user()->hasPermissionTo('delete_opération')) {
                    if ($lastOperations->id ?? null == $id) {
                        try {
                            $operation->delete();
                            return redirect()->route('entrees')->with('success', 'Opération supprimée avec succes');
                        } catch (Throwable $th) {
                            return back()->with('error', "Enregistrement échoué !" . $th);
                        }
                    } else {
                        return back()->with('error', 'Une erreur est survenue lors de la suppression');
                    }
                } else {
                    return back()->with('error', 'Une erreur est survenue lors de la suppression');
                }
            } else {
                return back()->with('error', 'Une erreur est survenue lors de la suppression');
            }
        } else {
            return back()->with('error', 'Une erreur est survenue lors de la suppression');
        }
    }
}
