<?php

namespace App\Interfaces;

interface ParticularRepositoryInterface
{
    public function getAllParticulars();
    public function createParticular(array $particularDetails);
}
