<?php


namespace Talentify\Infra\Opportunities;


use App\Models\Opportunity as OpportunityModel;
use DomainException;
use Talentify\Domain\Company\Company;
use Talentify\Domain\Opportunity\Opportunity;
use Talentify\Domain\Opportunity\OpportunityRepositoryInterface;
use Talentify\Domain\Recruiter\Recruiter;

class OpportunityRepository implements OpportunityRepositoryInterface
{

    public function findById(string $id): ?Opportunity
    {
        $opportunity = OpportunityModel::find($id);
        if (is_null($opportunity)) {
            return null;
        }
        return $this->toOpportunity($opportunity);
    }

    public function findByRecruiterId(string $recruiterId): ?array
    {
        $opportunities = OpportunityModel::where('recruiter_id', $recruiterId)->get();
        $results = [];
        foreach ($opportunities as $opportunity) {
            $results[] = $this->toOpportunity($opportunity);
        }
        return $results;
    }

    public function create(Opportunity $opportunity): Opportunity
    {
        OpportunityModel::create([
            'id' => $opportunity->getId(),
            'title' => $opportunity->getTitle(),
            'description' => $opportunity->getDescription(),
            'status' => $opportunity->getStatus(),
            'address' => $opportunity->getAddress(),
            'salary' => $opportunity->getSalary(),
            'company_id' => $opportunity->getCompany()->getId(),
            'recruiter_id' => $opportunity->getRecruiter()->getId()
        ]);

        return $opportunity;
    }

    public function update(Opportunity $opportunity, string $id): Opportunity
    {
        $record = OpportunityModel::find($id);
        if (is_null($record)) {
            throw new DomainException('Opportunity not exists.', 400);
        }
        $record->title = $opportunity->getTitle();
        $record->description = $opportunity->getDescription();
        $record->status = $opportunity->getStatus();
        $record->address = $opportunity->getAddress();
        $record->salary = $opportunity->getSalary();
        $record->company_id = $opportunity->getCompany()->getId();
        $record->recruiter_id = $opportunity->getRecruiter()->getId();
        $record->save();

        return $this->toOpportunity($record);
    }

    public function findAll(array $filters = []): array
    {
        if (count($filters)) {
            $opportunities = OpportunityModel::all();
        } else {
            $opportunities = OpportunityModel::where($filters)->get();
        }
        $results = [];
        foreach ($opportunities as $opportunity) {
            $results[] = $this->toOpportunity($opportunity);
        }
        return $results;
    }

    public function delete(string $id): void
    {
        $record = OpportunityModel::find($id);
        if (is_null($record)) {
            throw new DomainException('Opportunity not exists.', 400);
        }
        $record->delete();
    }

    private function toOpportunity($opportunity): Opportunity
    {
        $company = new Company(
            $opportunity->company->id,
            $opportunity->company->name
        );

        $recruiter = Recruiter::createWithString(
            $opportunity->recruiter->id,
            $opportunity->recruiter->name,
            $opportunity->recruiter->email,
            $opportunity->company->name,
            $opportunity->company->id
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
