<?php


namespace Talentify\Application\Opportunity;

use DomainException;
use Talentify\Domain\Opportunity\Opportunity;
use Talentify\Domain\Opportunity\OpportunityRepositoryInterface;
use Talentify\Domain\Recruiter\Recruiter;
use Talentify\Domain\Recruiter\RecruiterRepositoryInterface;
use Talentify\Domain\Services\ServiceIdGeneratorInterface;

class CreateOpportunity
{
    private OpportunityRepositoryInterface $opportunityRepository;
    private RecruiterRepositoryInterface $recruiterRepository;
    private ServiceIdGeneratorInterface $serviceIdGenerator;
    private Recruiter $recruiter;

    /**
     * CreateOpportunity constructor.
     * @param OpportunityRepositoryInterface $opportunity
     * @param RecruiterRepositoryInterface $recruiterRepository
     * @param ServiceIdGeneratorInterface $serviceIdGenerator
     */
    public function __construct(
        OpportunityRepositoryInterface $opportunity,
        RecruiterRepositoryInterface $recruiterRepository,
        ServiceIdGeneratorInterface $serviceIdGenerator
    )
    {
        $this->opportunityRepository = $opportunity;
        $this->recruiterRepository = $recruiterRepository;
        $this->serviceIdGenerator = $serviceIdGenerator;
    }

    public function create(OpportunityDto $dto): Opportunity
    {
        $this->validate($dto);
        $opportunity = new Opportunity(
            $this->serviceIdGenerator->create(),
            $dto->getTitle(),
            $dto->getDescription(),
            $dto->getStatus(),
            $dto->getAddress(),
            $dto->getSalary(),
            $this->recruiter->getCompany(),
            $this->recruiter
        );
        $this->opportunityRepository->create($opportunity);
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
    }

}
