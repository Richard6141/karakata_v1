<?php

namespace App\Repositories;

use App\Interfaces\SourceRepositoryInterface;
use App\Models\Source;

class SourceRepository implements SourceRepositoryInterface
{
    public function getAllSources ()
    {
        return Source::all();
    }
}
