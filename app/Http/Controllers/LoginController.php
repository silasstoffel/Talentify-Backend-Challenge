<?php

namespace App\Http\Controllers;

use DomainException;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Talentify\Application\Account\CreateAccountToken;
use Talentify\Application\Account\Login;
use Talentify\Infra\Account\AccountRepository;
use Talentify\Infra\Services\ServiceHashCreator;
use Talentify\Infra\Services\ServiceTokenManager;
use TypeError;

class LoginController extends Controller
{
    public function store(Request $request): JsonResponse
    {
        $useCase = new Login(
            new AccountRepository(),
            new ServiceHashCreator()
        );

        try {
            $account = $useCase->execute($request->email, $request->password);
            $serviceToken = new ServiceTokenManager(env('JWT_SECRET'));
            $token = new CreateAccountToken($serviceToken);
            $value = $token->create($account);

            return $this->responseSuccess([
                'account' => [
                    'name' => $account->getName(),
                    'email' => (string) $account->getEmail()
                ],
                'token' => $value,
            ]);
        } catch (DomainException | Exception $e) {
            return $this->responseUserError($e->getMessage(), 401);
        } catch (TypeError $e) {
            return $this->responseAppError('We are sorry, but for technical reasons it is possible to complete the request.');
        }
    }
}
