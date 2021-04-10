<?php


namespace Talentify\Application\Account;


use DomainException;
use Talentify\Domain\Account\Account;
use Talentify\Domain\Account\CreateAccountRepositoryInterface;
use Talentify\Domain\Services\ServiceHashCreatorInterface;

class Login
{
    private CreateAccountRepositoryInterface $accountRepository;
    private ServiceHashCreatorInterface $serviceHash;

    /**
     * Login constructor.
     * @param CreateAccountRepositoryInterface $accountRepository
     * @param ServiceHashCreatorInterface $serviceHash
     */
    public function __construct(
        CreateAccountRepositoryInterface $accountRepository,
        ServiceHashCreatorInterface $serviceHash)
    {
        $this->accountRepository = $accountRepository;
        $this->serviceHash = $serviceHash;
    }

    public function execute(string $email, string $password): Account
    {
        $account = $this->accountRepository->findByEmail($email);
        if (is_null($account)) {
            throw new DomainException('Account not exists.', 400);
        }
        if (!$this->serviceHash->verify($password, $account->getPassword())) {
            throw new DomainException('Invalid password.', 400);
        }
        return $account;
    }

}
