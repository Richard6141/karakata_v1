<?php

namespace App\Interfaces;

interface CompanyRepositoryInterface
{
    public function getAllCompany();
    public function createCompany(array $companyDetails);
}
