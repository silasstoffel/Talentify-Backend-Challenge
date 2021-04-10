<?php

namespace App\Http\Controllers;

use DomainException;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Talentify\Application\Account\CreateAccount;
use Talentify\Application\Account\CreateAccountDto;
use Talentify\Application\Recruiter\CreateRecruiter;
use Talentify\Application\Recruiter\CreateRecruiterDto;
use Talentify\Infra\Account\AccountRepository;
use Talentify\Infra\Company\CompanyRepository;
use Talentify\Infra\Recruiter\RecruiterRepository;
use Talentify\Infra\Services\ServiceHashCreator;
use Talentify\Infra\Services\UuidCreator;
use TypeError;

class RecruiterController extends Controller
{
    public function store(Request $request): JsonResponse
    {
        $uuidCreator = new UuidCreator();
        $useCaseRecruiter = new CreateRecruiter(
            new RecruiterRepository(),
            new CompanyRepository(),
            $uuidCreator
        );

        $name = $request->name;
        $email = $request->email;
        $companyId = $request->company_id;
        $password = $request->password;
        $id = null;

        $recruiterDto = new CreateRecruiterDto($id, $name, $email, $companyId);

        DB::beginTransaction();
        try {
            $accountCreated = $useCaseRecruiter->create($recruiterDto);
            $id = $accountCreated->getId();
            $profile = 'recruiters';

            $accountDto = new CreateAccountDto($name, $email, $password, $profile, $id);
            $useCaseAccount = new CreateAccount(
                new AccountRepository(),
                new ServiceHashCreator(),
                $uuidCreator
            );
            $useCaseAccount->create($accountDto);
            DB::commit();
        } catch (DomainException | Exception $e) {
            DB::rollBack();
            return $this->responseUserError($e->getMessage());
        } catch (TypeError $e) {
            return $this->responseAppError('We are sorry, but for technical reasons it is possible to complete the request.') ;
        }
        return $this->responseSuccess([], 201);
    }
}
