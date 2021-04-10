<?php


namespace Talentify\Application\Account;


use Talentify\Domain\Account\Account;
use Talentify\Domain\Services\ServiceTokenManagerInterface;

class CreateAccountToken
{
    private ServiceTokenManagerInterface $serviceTokenManager;

    /**
     * CreateAccountToken constructor.
     * @param ServiceTokenManagerInterface $serviceTokenManager
     */
    public function __construct(ServiceTokenManagerInterface $serviceTokenManager)
    {
        $this->serviceTokenManager = $serviceTokenManager;
    }

    public function create(Account $account): string
    {
        return $this->serviceTokenManager->create(
            ['key' => $account->getId()]
        );
    }
}
