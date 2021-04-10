<?php


namespace Talentify\Application\Account;


use Talentify\Domain\Account\Account;
use Talentify\Domain\Account\CreateAccountRepositoryInterface;
use Talentify\Domain\Services\ServiceTokenManagerInterface;


class AccountTokenValidate
{
    private CreateAccountRepositoryInterface $accountRepository;
    private ServiceTokenManagerInterface $token;
    private ?Account $account;

    /**
     * AccountTokenValidate constructor.
     * @param CreateAccountRepositoryInterface $accountRepository
     * @param ServiceTokenManagerInterface $token
     */
    public function __construct(
        CreateAccountRepositoryInterface $accountRepository,
        ServiceTokenManagerInterface $token
    )
    {
        $this->accountRepository = $accountRepository;
        $this->token = $token;
        $this->account = null;
    }

    public function validate(string $token): bool
    {
        $this->account = null;
        $decoded = $this->token->decode($token);
        if (!isset($decoded->key)) {
            return false;
        }
        $id = (string)$decoded->key;
        $account = $this->accountRepository->findById($id);
        if (is_null($account)) {
            return false;
        }
        $this->account = $account;
        return true;
    }

    public function getAccountValidate(): ?Account
    {
        return $this->account;
    }

}
