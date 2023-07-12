<?php

namespace App\Repositories;

use App\Models\Contain;
use App\Models\ComponentType;
use Illuminate\Support\Facades\DB;
use App\Interfaces\ContenirRepositoryInterface;

class ContenirRepository implements ContenirRepositoryInterface
{

    public function getMenuToDate()
    {
        // Type composant
        $componentType = ComponentType::where('label', 'Résistance')->first();


        $contains = Contain::select(DB::raw('DISTINCT(component_id)'), 'contains.*')
            ->where('date', date('Y-m-d'))
            ->where('status', true)
            ->where('component_type_id', $componentType->id)
            ->get();
            
        $contains = $contains->groupBy('component_id');

        // Menu du jour
        // $contains = Contain::where('date', date('Y-m-d'))->where('component_type_id', $componentType->id)->where('status', true)->get();
        return $contains ?? [];
    }
}
