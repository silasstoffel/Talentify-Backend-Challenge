<?php


namespace Talentify\Domain\Account;

use Talentify\Domain\Account\Account;


interface CreateAccountRepositoryInterface
{
    public function create(Account $account): Account;
}
