<?php


namespace Talentify\Domain\Account;

interface CreateAccountRepositoryInterface
{
    public function create(Account $account): Account;

    public function findByEmail(string $email): ?Account;

    public function findById(string $id): ?Account;

}
