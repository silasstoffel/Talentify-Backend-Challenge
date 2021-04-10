<?php

namespace Database\Seeders;

use App\Models\Account;
use App\Models\Recruiter;
use Illuminate\Database\Seeder;
use Talentify\Infra\Services\ServiceHashCreator;


class CreateInitialRecruiters extends Seeder
{

    public function run()
    {
        $this->createRecruiterWithAccount();
    }

    private function createRecruiterWithAccount()
    {
        $recruiters = [
            [
                'name' => 'Recruiter #01',
                'email' => 'recruiter1@talentify.com',
                'company_id' => '69908679-11c8-4fca-8635-ec3d9042dd14',
                'id' => '129dc0f7-8007-4763-9829-2db288d5f51c'
            ],
            [
                'name' => 'Recruiter #02',
                'email' => 'recruiter2@talentify.com',
                'company_id' => '1dc16a2c-ddab-44f4-8ff2-3b1d2c35f7e1',
                'id' => '1dc16a2c-ddab-44f4-8ff2-3b1d2c35f7e1'
            ]
        ];

        $passwordCreator = new ServiceHashCreator();
        foreach ($recruiters as $recruiter) {
            $checkRecruiter = Recruiter::find($recruiter['id']);
            if (!isset($checkRecruiter->id)) {
                $this->createRecruiter($recruiter);
                $pwd = $passwordCreator->create('talentify');
                $data = array_merge(
                    $recruiter,
                    ['key' => $recruiter['id'], 'password' => $pwd]
                );
                $this->createAccount($data);
            }
        }
    }

    private function createRecruiter(array $recruiter)
    {
        $model = new Recruiter();
        $model->id = $recruiter['id'];
        $model->email = $recruiter['email'];
        $model->company_id = $recruiter['company_id'];
        $model->name = $recruiter['name'];
        $model->save();
        return $model;
    }

    private function createAccount(array $data)
    {
        $model = new Account();
        $model->id = $data['id'];
        $model->name = $data['name'];
        $model->email = $data['email'];
        $model->password = $data['password'];
        $model->profile = 'recruiters';
        $model->key = $data['key'];
        $model->save();
    }
}
