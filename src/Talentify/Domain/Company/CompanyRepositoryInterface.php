<?php


namespace Talentify\Domain\Company;

interface CompanyRepositoryInterface
{
    public function findById(string $id): ?Company;
}
