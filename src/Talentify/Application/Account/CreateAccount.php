<?php


namespace Talentify\Application\Account;

use Talentify\Application\Account\CreateAccountDto;
use Talentify\Domain\Account\Account;
use Talentify\Domain\Email;

class CreateAccount
{
    private CreateAccountDto $dto;
    private CreateAccountRepositoryInterface $repository;
    private ServiceHashCreatorInterface $serviceHashCreator;

    /**
     * CreateAccount constructor.
     * @param CreateAccountDto $dto
     */
    public function __construct(
        CreateAccountDto $dto,
        CreateAccountRepositoryInterface $repository,
        ServiceHashCreatorInterface $serviceHashCreator,
    )
    {
        $this->dto = $dto;
    }

    public function create()
    {
        $mail = new Email($this->dto->getEmail());

        $account = new Account(
            null,
            $this->dto->getName(),
            $mail,
            $this->dto->getPassword(),
            $this->dto->getProfile(),
            $this->dto->getKey()
        );

        return $this->repository->create($account);
    }

}

