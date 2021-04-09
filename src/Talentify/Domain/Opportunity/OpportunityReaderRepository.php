<?php


namespace Talentify\Domain\Opportunity;

use Talentify\Domain\Opportunity\Opportunity;


interface OpportunityReaderRepository
{
    public function findById(int $id): ?Opportunity;

    public function findByRecruiterId(int $recruiterId): ?array;
}
