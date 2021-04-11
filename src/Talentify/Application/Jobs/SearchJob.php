<?php


namespace Talentify\Application\Jobs;


use Talentify\Domain\Opportunity\FilterOpportunitiesInterface;
use Talentify\Domain\Opportunity\Opportunity;

class SearchJob
{
    private FilterOpportunitiesInterface $repository;

    /**
     * SearchJob constructor.
     * @param FilterOpportunitiesInterface $repository
     */
    public function __construct(FilterOpportunitiesInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param SearchJobsDto $dto Dto
     * @return Opportunity[]
     */
    public function search(SearchJobsDto $dto): array
    {
        return $this->repository->filter($dto);
    }
}
