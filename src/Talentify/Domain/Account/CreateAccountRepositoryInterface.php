<?php


namespace Talentify\Domain\Account;

interface CreateAccountRepositoryInterface
{
    public function create(Account $account): Account;
}
