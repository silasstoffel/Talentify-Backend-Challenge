<?php


namespace Talentify\Application\Recruiter;


use DomainException;
use Talentify\Domain\Company\CompanyRepositoryInterface;
use Talentify\Domain\Email;
use Talentify\Domain\Recruiter\RecruiterRepositoryInterface;
use Talentify\Domain\Recruiter\Recruiter;
use Talentify\Domain\Services\ServiceIdGeneratorInterface;

class CreateRecruiter
{
    private RecruiterRepositoryInterface $recruiterRepository;
    private ServiceIdGeneratorInterface $uuid;
    private CompanyRepositoryInterface $companyRepository;

    /**
     * CreateRecruiter constructor.
     * @param RecruiterRepositoryInterface $recruiterRepository
     * @param CompanyRepositoryInterface $companyRepository
     * @param ServiceIdGeneratorInterface $uuid
     */
    public function __construct(
        RecruiterRepositoryInterface $recruiterRepository,
        CompanyRepositoryInterface $companyRepository,
        ServiceIdGeneratorInterface $uuid
    )
    {
        $this->recruiterRepository = $recruiterRepository;
        $this->companyRepository = $companyRepository;
        $this->uuid = $uuid;
    }

    public function create(CreateRecruiterDto $recruiterDto): Recruiter
    {
        $recruiter = $this->recruiterRepository->findByEmail($recruiterDto->getEmail());
        if (!is_null($recruiter)) {
            throw new DomainException('The e-mail address entered is linked to another company.', 400);
        }

        return $this->recruiterRepository->create(
            $this->dtoToRecruiter($recruiterDto)
        );
    }

    private function dtoToRecruiter(CreateRecruiterDto $recruiterDto): Recruiter
    {
        $mail = new Email($recruiterDto->getEmail());
        $company = $this->companyRepository->findById(
            $recruiterDto->getCompanyId()
        );
        if (is_null($company)) {
            throw new DomainException('Company not exists.', 400);
        }
        return new Recruiter(
            $this->uuid->create(),
            $recruiterDto->getName(),
            $mail,
            $company
        );
    }
}
