<?php


namespace Talentify\Infra\Company;


use Talentify\Domain\Company\Company;
use Talentify\Domain\Company\CompanyRepositoryInterface;

class CompanyRepository implements CompanyRepositoryInterface
{

    public function findById(string $id): ?Company
    {
        $company = \App\Models\Company::find($id);
        if (!is_null($company)) {
            return new Company(
                $company->id,
                $company->name
            );
        }
        return null;
    }
}
