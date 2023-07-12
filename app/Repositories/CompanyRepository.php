<?php

namespace App\Repositories;

use App\Interfaces\CompanyRepositoryInterface;
use App\Models\Company;

class CompanyRepository implements CompanyRepositoryInterface
{
    public function getAllCompany()
    {
        return Company::all();
    }

    public function createCompany(array $companyDetails)
    {
        return Company::create($companyDetails);
    }
}
