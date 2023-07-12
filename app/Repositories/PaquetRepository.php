<?php

namespace App\Repositories;

use App\Models\Paquet;
use App\Models\Contain;
use Illuminate\Support\Facades\DB;
use App\Interfaces\PaquetRepositoryInterface;

class PaquetRepository implements PaquetRepositoryInterface
{
    public function getAllPaquets ()
    {
        return Paquet::all();
    }

    public function getActivePaquetToDay ()
    {
        $paquets = Contain::select( DB::raw('DISTINCT(paquet_id)'))
        ->where('date', date('Y-m-d'))
        ->where('status', true)
        ->get();

        return $paquets ?? [];
    }
}
