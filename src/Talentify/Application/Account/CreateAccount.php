<?php


namespace Talentify\Application\Account;

use DomainException;
use Talentify\Domain\Account\Account;
use Talentify\Domain\Account\CreateAccountRepositoryInterface;
use Talentify\Domain\Email;
use Talentify\Domain\Services\ServiceHashCreatorInterface;
use Talentify\Domain\Services\ServiceIdGeneratorInterface;

class CreateAccount
{
    private CreateAccountRepositoryInterface $repository;
    private ServiceHashCreatorInterface $serviceHashCreator;
    private ServiceIdGeneratorInterface $serviceIdGenerator;

    /**
     * CreateAccount constructor.
     * @param CreateAccountRepositoryInterface $createAccountRepository Create account repository.
     * @param ServiceHashCreatorInterface $serviceHashCreator Service hash creator.
     * @param ServiceIdGeneratorInterface $serviceIdGenerator Service ID Generator.
     */
    public function __construct(
        CreateAccountRepositoryInterface $createAccountRepository,
        ServiceHashCreatorInterface $serviceHashCreator,
        ServiceIdGeneratorInterface $serviceIdGenerator
    )
    {
        $this->repository = $createAccountRepository;
        $this->serviceHashCreator = $serviceHashCreator;
        $this->serviceIdGenerator = $serviceIdGenerator;
    }

    /**
     * Create account.
     * @param CreateAccountDto $accountDto
     * @return Account account created.
     */
    public function create(CreateAccountDto $accountDto): Account
    {
        if (!strlen($accountDto->getPassword())) {
            throw  new DomainException('Password is required.', 400);
        }
        $account = $this->accountDtoToAccount($accountDto);
        return $this->repository->create($account);
    }

    private function accountDtoToAccount(CreateAccountDto $accountDto): Account
    {
        $mail = new Email($accountDto->getEmail());
        $hash = $this->serviceHashCreator->create($accountDto->getPassword());
        return new Account(
            $this->serviceIdGenerator->create(),
            $accountDto->getName(),
            $mail,
            $hash,
            $accountDto->getProfile(),
            $accountDto->getKey()
        );
    }
}

