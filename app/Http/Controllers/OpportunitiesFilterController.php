<?php


namespace App\Http\Controllers;


use DomainException;
use Exception;
use Illuminate\Http\Request;
use Talentify\Application\Jobs\SearchJob;
use Talentify\Application\Jobs\SearchJobsDto;
use Talentify\Domain\Opportunity\Opportunity;
use Talentify\Infra\Opportunities\OpportunityFilterRepository;
use TypeError;

class OpportunitiesFilterController extends Controller
{

    public function index(Request $request)
    {
        // query string: keyword, address, salary, company
        $address = $request->address ?? null;
        $keyword = $request->keyword ?? null;
        $salary = $request->salary ?? null;
        $company = $request->company ?? null;

        try {
            $searchDto = new SearchJobsDto(
                $address,
                $salary,
                $company,
                $keyword,
                [Opportunity::STATUS_OPEN]
            );
            $useCase = new SearchJob(new OpportunityFilterRepository());
            $items = $useCase->search($searchDto);
            $results = $this->prepareResponse($items);
            return $this->responseSuccess($results);
        } catch (DomainException | Exception $e) {
            return $this->responseUserError($e->getMessage(), 400);
        } catch (TypeError $e) {
            return $this->responseAppError('We are sorry, but for technical reasons it is possible to complete the request.');
        }
    }

    private function prepareResponse(array $items): array
    {
        $results = [];
        foreach ($items as $item) {
            $results[] = $this->opportunityToResponse($item);
        }
        return $results;
    }

    private function opportunityToResponse(Opportunity $item): array
    {
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
                'email' => (string)$item->getRecruiter()->getEmail(),
                'company_id' => $item->getRecruiter()->getCompany()->getId(),
            ]
        ];
    }
}
