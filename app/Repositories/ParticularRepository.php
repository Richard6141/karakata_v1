<?php

namespace App\Repositories;

use App\Interfaces\ParticularRepositoryInterface;
use App\Models\Particular;

class ParticularRepository implements ParticularRepositoryInterface
{
    public function getAllParticulars ()
    {
        return Particular::all();
    }

    public function createParticular (array $particularDetails)
    {
        return Particular::create($particularDetails);
    }
}
