<?php


namespace Talentify\Application\Opportunity;


use DomainException;
use Talentify\Domain\Opportunity\Opportunity;
use Talentify\Domain\Opportunity\OpportunityRepositoryInterface;
use Talentify\Domain\Recruiter\RecruiterRepositoryInterface;

class UpdateOpportunity
{
    private OpportunityRepositoryInterface $opportunityRepository;
    private RecruiterRepositoryInterface $recruiterRepository;
    private Opportunity $opportunity;


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

    public function execute(OpportunityDto $dto): Opportunity
    {
        $this->validate($dto);
        $opportunity = new Opportunity(
            $this->opportunity->getId(),
            $dto->getTitle(),
            $dto->getDescription(),
            $dto->getStatus(),
            $dto->getAddress(),
            $dto->getSalary(),
            $this->opportunity->getCompany(),
            $this->opportunity->getRecruiter()
        );
        $this->opportunityRepository->update($opportunity, $this->opportunity->getId());
        return $opportunity;

    }
    private function validate(OpportunityDto $dto) {

        if (strlen(trim($dto->getRecruiterId())) != 36) {
            throw new DomainException('Recruiter is required or is invalid.',400);
        }

        $recruiter = $this->recruiterRepository->findById($dto->getRecruiterId());
        if (is_null($recruiter)) {
            throw new DomainException('Recruiter not found.',400);
        }
        $this->recruiter = $recruiter;

        $opportunity = $this->opportunityRepository->findById($dto->getId());
        if (is_null($opportunity)) {
            throw new DomainException('Opportunity not found.',400);
        }

        if ($opportunity->getRecruiter()->getId() !== $dto->getRecruiterId()) {
            throw new DomainException('Opportunity cannot be changed.',400);
        }

        $this->opportunity = $opportunity;
    }


}
