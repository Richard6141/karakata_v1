<?php
namespace App\Interfaces;

interface PaquetRepositoryInterface
{
    public function getAllPaquets();
    public function getActivePaquetToDay();
}
