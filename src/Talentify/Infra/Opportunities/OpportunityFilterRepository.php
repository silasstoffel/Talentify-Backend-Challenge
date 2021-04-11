<?php


namespace Talentify\Infra\Opportunities;


use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;
use Talentify\Application\Jobs\SearchJobsDto;
use Talentify\Domain\Company\Company;
use Talentify\Domain\Opportunity\FilterOpportunitiesInterface;
use Talentify\Domain\Opportunity\Opportunity;
use Talentify\Domain\Recruiter\Recruiter;

class OpportunityFilterRepository implements FilterOpportunitiesInterface
{
    /**
     * @param SearchJobsDto $dto
     * @return array
     */
    public function filter(SearchJobsDto $dto): array
    {
        $query = DB::table('opportunities')
            ->join('recruiters', 'recruiters.id', '=', 'opportunities.recruiter_id')
            ->join('companies', 'companies.id', '=', 'opportunities.company_id');

        $this->applyFilters($query, $dto);
        $results = $query->get($this->getColumns());
        $items = [];
        foreach ($results as $item) {
            $items[] = $this->toOpportunity($item);
        }
        return  $items;
    }

    private function getColumns(): array
    {
        return [
            'opportunities.id',
            'opportunities.title',
            'opportunities.description',
            'opportunities.status',
            'opportunities.address',
            'opportunities.salary',
            'opportunities.company_id',
            'opportunities.recruiter_id',
            'companies.name AS company_name',
            'recruiters.email',
            'recruiters.name AS recruiter_name'
        ];
    }

    private function applyFilters(Builder $query, SearchJobsDto $dto)
    {
        $query->whereRaw('1=1');
        $status = $dto->getStatus();
        if (count($status) && !in_array('*', $status)) {
            $query->whereIn('opportunities.status', $status);
        }

        if (strlen($dto->getCompanyName())) {
            $query->where('companies.name','LIKE' , '%'.$dto->getCompanyName() .'%');
        }

        if (strlen($dto->getAddress())) {
            $query->where('opportunities.address','LIKE' , '%'.$dto->getAddress() .'%');
        }

        if (strlen($dto->getSalary())) {
            $query->where('opportunities.salary','>=' , $dto->getSalary());
        }

        $keyword = $dto->getKeyword();
        if (strlen($keyword)) {
            $query->where(function($query) use($keyword) {
                $query->where('opportunities.title', 'LIKE', '%' . $keyword . '%')
                    ->orWhere('opportunities.description',  'LIKE', '%' . $keyword . '%');
            });
        }
    }

    private function toOpportunity($opportunity): Opportunity
    {
        $company = new Company(
            $opportunity->company_id,
            $opportunity->company_name
        );

        $recruiter = Recruiter::createWithString(
            $opportunity->recruiter_id,
            $opportunity->recruiter_name,
            $opportunity->email,
            $opportunity->company_name,
            $opportunity->company_id
        );

        return new Opportunity(
            $opportunity->id,
            $opportunity->title,
            $opportunity->description,
            $opportunity->status,
            $opportunity->address,
            $opportunity->salary,
            $company,
            $recruiter
        );
    }
}
