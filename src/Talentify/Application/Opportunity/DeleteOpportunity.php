<?php


namespace Talentify\Application\Opportunity;


use DomainException;
use Talentify\Domain\Opportunity\OpportunityRepositoryInterface;
use Talentify\Domain\Recruiter\RecruiterRepositoryInterface;

class DeleteOpportunity
{
    private OpportunityRepositoryInterface $opportunityRepository;
    private RecruiterRepositoryInterface $recruiterRepository;

    /**
     * UpdateOpportunity constructor.
     * @param OpportunityRepositoryInterface $opportunityRepository
     * @param RecruiterRepositoryInterface $recruiterRepository
     */
    public function __construct(
        OpportunityRepositoryInterface $opportunityRepository,
        RecruiterRepositoryInterface $recruiterRepository
    )
    {
        $this->opportunityRepository = $opportunityRepository;
        $this->recruiterRepository = $recruiterRepository;
    }

    public function execute(DeleteOportunityDto $dto)
    {
        $this->validate($dto);
        $this->opportunityRepository->delete($dto->getId());
    }
    private function validate(DeleteOportunityDto $dto) {

        $recruiterId = $dto->getRecruiterId();
        if (strlen(trim($recruiterId)) != 36) {
            throw new DomainException('Recruiter is required or is invalid.',400);
        }
        $recruiter = $this->recruiterRepository->findById($recruiterId);
        if (is_null($recruiter)) {
            throw new DomainException('Recruiter not found.',400);
        }

        $opportunity = $this->opportunityRepository->findById($dto->getId());
        if (is_null($opportunity)) {
            throw new DomainException('Opportunity not found.',400);
        }

        if ($opportunity->getRecruiter()->getId() !== $dto->getRecruiterId()) {
            throw new DomainException('Opportunity cannot be deleted.',400);
        }
    }
}
