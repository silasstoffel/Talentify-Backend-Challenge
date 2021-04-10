<?php


namespace Talentify\Application\Opportunity;


use DomainException;
use Talentify\Domain\Opportunity\Opportunity;
use Talentify\Domain\Opportunity\OpportunityRepositoryInterface;

class LoadOpportunity
{
    private OpportunityRepositoryInterface $repository;

    /**
     * LoadOpportunity constructor.
     * @param OpportunityRepositoryInterface $repository
     */
    public function __construct(OpportunityRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function load(string $id, ?string $recruiterId = null): Opportunity
    {
        $opportunity = $this->repository->findById($id);
        if (is_null($opportunity)) {
            throw  new DomainException('Opportunity not found.', 404);
        }
        if ($recruiterId && $opportunity->getRecruiter()->getId() !== $recruiterId) {
            throw  new DomainException('Opportunity linked to another recruiter.', 404);
        }
        return $opportunity;
    }

}
