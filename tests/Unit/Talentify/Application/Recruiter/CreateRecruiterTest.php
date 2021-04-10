<?php

namespace Unit\Talentify\Application\Recruiter;

use DomainException;
use Talentify\Application\Recruiter\CreateRecruiter;
use Talentify\Application\Recruiter\CreateRecruiterDto;
use Talentify\Domain\Recruiter\Recruiter;
use Talentify\Infra\Company\CompanyRepository;
use Talentify\Infra\Recruiter\CreateRecruiterRepository;
use Talentify\Infra\Services\UuidCreator;
use TestCase;

class CreateRecruiterTest extends TestCase
{
    private Recruiter $recruiteBase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->recruiteBase = Recruiter::createWithString(
            '72291e82-ce52-480d-8e5b-efe1b5d5813a',
            'Talentify#1',
            'talentify1@email.com',
            'Talentify',
            '4a58ee83-2007-4b2b-987f-2d8fd173562a'
        );
    }

    public function testShouldCreateRecruiter()
    {
        $useCase = new CreateRecruiter(
            $this->getRecruiterRepository($this->recruiteBase),
            $this->getCompanyRepository($this->recruiteBase->getCompany()),
            new UuidCreator()
        );

        $dto = new CreateRecruiterDto(
            null,
            $this->recruiteBase->getName(),
            $this->recruiteBase->getEmail(),
            $this->recruiteBase->getCompany()->getId()
        );

        $recruiter = $useCase->create($dto);

        $this->assertEquals($this->recruiteBase->getName(), $recruiter->getName());
        $this->assertEquals((string)$this->recruiteBase->getEmail(), (string)$recruiter->getEmail());
        $this->assertEquals($this->recruiteBase->getCompany()->getId(), $recruiter->getCompany()->getId());
    }

    public function testShouldNotCreateRecruiterWithoutCompany()
    {
        $this->expectException(DomainException::class);
        $this->expectExceptionMessage('Company not exists.');
        $this->expectExceptionCode(400);

        $useCase = new CreateRecruiter(
            $this->getRecruiterRepository($this->recruiteBase),
            $this->getCompanyRepository(null),
            new UuidCreator()
        );

        $dto = new CreateRecruiterDto(
            null,
            $this->recruiteBase->getName(),
            $this->recruiteBase->getEmail(),
            $this->recruiteBase->getCompany()->getId()
        );

        $useCase->create($dto);
    }

    public function testShouldNotCreateRecruiterWithRegisteredEmail()
    {
        $this->expectException(DomainException::class);
        $this->expectExceptionMessage('The e-mail address entered is linked to another company.');
        $this->expectExceptionCode(400);

        $findByEmail = Recruiter::createWithString(
            '72291e82-ce52-480d-8e5b-efe1b5d5813b',
            'Talentify#2',
            'talentify1@email.com',
            'Talentify',
            '4a58ee83-2007-4b2b-987f-2d8fd173562z'
        );

        $useCase = new CreateRecruiter(
            $this->getRecruiterRepository($this->recruiteBase, $findByEmail),
            $this->getCompanyRepository(null),
            new UuidCreator()
        );

        $dto = new CreateRecruiterDto(
            null,
            $this->recruiteBase->getName(),
            $this->recruiteBase->getEmail(),
            $this->recruiteBase->getCompany()->getId()
        );

        $useCase->create($dto);
    }

    private function getRecruiterRepository($createdReturn = null, $findByEmailReturn = null): CreateRecruiterRepository
    {
        $repository = $this->createMock(CreateRecruiterRepository::class);
        $repository->method('create')->willReturn($createdReturn);

        $repository->method('findByEmail')->willReturn($findByEmailReturn);
        /**@var CreateRecruiterRepository $repository */
        return $repository;
    }

    private function getCompanyRepository($findByIdReturn = null): CompanyRepository
    {
        $repository = $this->createMock(CompanyRepository::class);
        $repository->method('findById')->willReturn($findByIdReturn);
        /**@var CompanyRepository $repository */
        return $repository;
    }


}
