<?php


namespace App\Http\Controllers;


use DomainException;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Talentify\Application\Opportunity\CreateOpportunity;
use Talentify\Application\Opportunity\DeleteOportunityDto;
use Talentify\Application\Opportunity\DeleteOpportunity;
use Talentify\Application\Opportunity\ListOpportunities;
use Talentify\Application\Opportunity\LoadOpportunity;
use Talentify\Application\Opportunity\OpportunityDto;
use Talentify\Application\Opportunity\UpdateOpportunity;
use Talentify\Domain\Opportunity\Opportunity;
use Talentify\Domain\Opportunity\OpportunityRepositoryInterface;
use Talentify\Infra\Opportunities\OpportunityRepository;
use Talentify\Infra\Recruiter\RecruiterRepository;
use Talentify\Infra\Services\UuidCreator;
use TypeError;

class OpportunityController extends Controller
{

    private OpportunityRepositoryInterface $repository;

    /**
     * OpportunityController constructor.
     */
    public function __construct()
    {
        $this->repository =  new OpportunityRepository();
    }

    public function index()
    {
        try {
            $opportunities = new ListOpportunities($this->repository);
            $account = Auth::user();
            $recruiterId = $account->key;
            $response = [];
            /** @var Opportunity[] $items */
            $items = $opportunities->list($recruiterId);
            foreach ($items as $item) {
                $response[] = $this->opportunityToResponse($item);
            }
            return $this->responseSuccess($response);
        } catch (DomainException | Exception $e) {
            return $this->responseUserError($e->getMessage());
        } catch (TypeError $e) {
            return $this->responseAppError('We are sorry, but for technical reasons it is possible to complete the request.');
        }
    }

    public function get(string $id)
    {
        $account = Auth::user();
        $recruiterId = $account->key;
        try {
            $useCase = new LoadOpportunity($this->repository);
            $opportunity = $useCase->load($id, $recruiterId );
            $res = $this->opportunityToResponse($opportunity);
            return $this->responseSuccess($res);
        } catch (DomainException | Exception $e) {
            return $this->responseUserError($e->getMessage(), 400);
        } catch (TypeError $e) {
            return $this->responseAppError('We are sorry, but for technical reasons it is possible to complete the request.');
        }
    }

    public function store(Request $request)
    {
        $account = Auth::user();
        $recruiterId = $account->key;

        $dto = new OpportunityDto(
            null,
            $request->title,
            $request->description,
            $request->status,
            $request->salary,
            '',
            $recruiterId,
            $request->address
        );

        try {
            $useCase = new CreateOpportunity(
                new OpportunityRepository(),
                new RecruiterRepository(),
                new UuidCreator()
            );
            $opportunity = $useCase->create($dto);
            $res = $this->opportunityToResponse($opportunity);
            return $this->responseSuccess($res, 201);
        } catch (DomainException | Exception $e) {
            return $this->responseUserError($e->getMessage(), 400);
        } catch (TypeError $e) {
            return $this->responseAppError('We are sorry, but for technical reasons it is possible to complete the request.');
        }
    }

    public function update(Request $request, string $id)
    {
        $account = Auth::user();
        $recruiterId = $account->key;

        $dto = new OpportunityDto(
            $id,
            $request->title,
            $request->description,
            $request->status,
            $request->salary,
            '',
            $recruiterId,
            $request->address
        );

        try {
            $useCase = new UpdateOpportunity(
                new OpportunityRepository(),
                new RecruiterRepository()
            );
            $opportunity = $useCase->execute($dto);
            $res = $this->opportunityToResponse($opportunity);
            return $this->responseSuccess($res);
        } catch (DomainException | Exception $e) {
            return $this->responseUserError($e->getMessage(), 400);
        } catch (TypeError $e) {
            return $this->responseAppError('We are sorry, but for technical reasons it is possible to complete the request.');
        }
    }

    public function delete(string $id)
    {
        $account = Auth::user();
        $recruiterId = $account->key;
        $opportunityDto = new DeleteOportunityDto($id, $recruiterId);
        try {
            $useCase = new DeleteOpportunity(
                new OpportunityRepository(),
                new RecruiterRepository()
            );
            $useCase->execute($opportunityDto);
            return $this->responseSuccess(null,204);
        } catch (DomainException | Exception $e) {
            return $this->responseUserError($e->getMessage(), 400);
        } catch (TypeError $e) {
            return $this->responseAppError('We are sorry, but for technical reasons it is possible to complete the request.');
        }
    }

    private function opportunityToResponse(Opportunity $item): array {
        return [
            'id' => $item->getId(),
            'title' => $item->getTitle(),
            'description' => $item->getDescription(),
            'status' => $item->getStatus(),
            'address' => $item->getAddress(),
            'salary' => $item->getSalary(),
            'company_id' => $item->getCompany()->getId(),
            'recruiter_id' => $item->getRecruiter()->getId(),
            'company' => [
                'id' => $item->getCompany()->getId(),
                'name' => $item->getCompany()->getName()
            ],
            'recruiter' => [
                'id' => $item->getRecruiter()->getId(),
                'name' => $item->getRecruiter()->getName(),
                'email' => (string) $item->getRecruiter()->getEmail(),
                'company_id' => $item->getRecruiter()->getCompany()->getId(),
            ]
        ];
    }


}
