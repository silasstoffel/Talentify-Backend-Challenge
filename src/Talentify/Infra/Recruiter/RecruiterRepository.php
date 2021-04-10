<?php


namespace Talentify\Infra\Recruiter;


use App\Models\Company;
use Talentify\Domain\Recruiter\RecruiterRepositoryInterface;
use Talentify\Domain\Recruiter\Recruiter;

class RecruiterRepository implements RecruiterRepositoryInterface
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

    /**
     * @param string $email email
     * @return Recruiter|null
     */
    public function findByEmail(string $email): ?Recruiter
    {
        $data = \App\Models\Recruiter::where('email', $email)->first();
        if (!is_null($data)) {
            $company = Company::find($data->company_id);
            return Recruiter::createWithString(
                $data->id,
                $data->name,
                $data->email,
                $company->name,
                $data->company_id
            );
        }
        return null;
    }

    /**
     * @param float $id
     * @return mixed
     */
    public function findById(string $id): ?Recruiter
    {
        $data = \App\Models\Recruiter::find($id);
        if (!is_null($data)) {
            $company = Company::find($data->company_id);
            return Recruiter::createWithString(
                $data->id,
                $data->name,
                $data->email,
                $company->name,
                $data->company_id
            );
        }
        return null;
    }
}
