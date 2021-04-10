<?php


namespace Talentify\Infra\Account;


use App\Models\Account as AccountModel;
use Talentify\Domain\Account\Account;
use Talentify\Domain\Account\CreateAccountRepositoryInterface;

class AccountRepository implements CreateAccountRepositoryInterface
{

    public function create(Account $account): Account
    {
        $model = new AccountModel();
        $model->id = $account->getId();
        $model->name = $account->getName();
        $model->email = $account->getEmail();
        $model->password = $account->getPassword();
        $model->profile = $account->getProfile();
        $model->key = $account->getKey();
        $model->save();

        return $account;
    }
}
