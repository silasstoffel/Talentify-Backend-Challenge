<?php


namespace Talentify\Infra\Account;


use App\Models\Account as AccountModel;
use Talentify\Domain\Account\Account;
use Talentify\Domain\Account\CreateAccountRepositoryInterface;
use Talentify\Domain\Email;

class AccountRepository implements CreateAccountRepositoryInterface
{

    /**
     * Store account
     * @param Account $account Account
     * @return Account
     */
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

    /**
     * Find account by e-mail
     * @param string $email email address
     * @return Account|null
     */
    public function findByEmail(string $email): ?Account
    {
        $result = AccountModel::where('email', $email)->first();
        if (isset($result->id)) {
            $mail = new Email($result->email);
            return new Account(
                $result->id,
                $result->name,
                $mail,
                $result->password,
                $result->profile,
                $result->key
            );
        }
        return null;
    }
}
