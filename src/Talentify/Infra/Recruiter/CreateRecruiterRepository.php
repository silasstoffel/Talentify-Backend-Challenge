<?php


namespace Talentify\Infra\Recruiter;


use Talentify\Domain\Recruiter\CreateRecruiterRepositoryInterface;
use Talentify\Domain\Recruiter\Recruiter;

class CreateRecruiterRepository implements CreateRecruiterRepositoryInterface
{

    public function create(Recruiter $recruiter): Recruiter
    {
        $model = new \App\Models\Recruiter();
        $model->id = $recruiter->getId();
        $model->email = $recruiter->getEmail();
        $model->name = $recruiter->getName();
        $model->company_id = $recruiter->getCompany()->getId();
        $model->save();
        return $recruiter;
    }
}
