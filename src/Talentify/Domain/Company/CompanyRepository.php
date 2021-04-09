<?php


namespace Talentify\Domain\Company;

use Talentify\Domain\Company\Company;


interface CompanyRepository
{
    public function findById(string $id): ?Company;
}
