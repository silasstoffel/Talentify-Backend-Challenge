<?php


namespace Talentify\Application\Opportunity;


use Talentify\Domain\Opportunity\OpportunityRepositoryInterface;

class ListOpportunities
{
    private OpportunityRepositoryInterface $repository;

    /**
     * ListOpportunities constructor.
     * @param OpportunityRepositoryInterface $repository
     */
    public function __construct(OpportunityRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function list(string $recruiterId): array
    {
        return $this->repository->findAll([
            ['recruiter_id', '=', $recruiterId]
        ]);
    }

}
