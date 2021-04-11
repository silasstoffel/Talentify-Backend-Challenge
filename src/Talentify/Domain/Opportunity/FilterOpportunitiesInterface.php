<?php


namespace Talentify\Domain\Opportunity;


use Talentify\Application\Jobs\SearchJobsDto;

interface FilterOpportunitiesInterface
{
    /**
     * @param SearchJobsDto $dto
     * @return Opportunity[]
     */
    public function filter(SearchJobsDto $dto): array;
}
