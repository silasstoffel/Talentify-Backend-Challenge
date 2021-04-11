<?php

namespace App\Providers;

use Exception;
use Illuminate\Auth\GenericUser;
use Illuminate\Support\ServiceProvider;
use Talentify\Application\Account\AccountTokenValidate;
use Talentify\Domain\Account\Account;
use Talentify\Infra\Account\AccountRepository;
use Talentify\Infra\Services\ServiceTokenManager;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Boot the authentication services for the application.
     *
     * @return void
     */
    public function boot()
    {
        $this->app['auth']->viaRequest('api', function ($request) {

            if (!$request->hasHeader('Authorization')) {
                return null;
            }

            $authorization = $request->header('Authorization', null);
            $jwt = str_replace('Bearer ', '', $authorization);

            $serviceToken = new AccountTokenValidate(
                new AccountRepository(),
                new ServiceTokenManager(env('JWT_SECRET')),
            );

            try {
                $serviceToken->validate($jwt);
                $account = $serviceToken->getAccountValidate();
                //var_export($account);
                if ($account instanceof Account) {
                    return new GenericUser([
                        'id' => $account->getId(),
                        'name' => $account->getName(),
                        'email' => $account->getEmail(),
                        'profile' => $account->getProfile(),
                        'key' => $account->getKey()
                    ]);
                }
            } catch (Exception $e) {
                return null;
            }
            return null;
        });
    }
}
