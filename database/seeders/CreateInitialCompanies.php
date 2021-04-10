<?php

namespace Database\Seeders;

use App\Models\Company;
use Illuminate\Database\Seeder;

class CreateInitialCompanies extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $companies = [
            ['id' => '69908679-11c8-4fca-8635-ec3d9042dd14', 'name' => 'Company I'],
            ['id' => '1dc16a2c-ddab-44f4-8ff2-3b1d2c35f7e1', 'name' => 'Company II'],
            ['id' => 'a2ac3097-f7c7-4d56-91da-afcc14cdae56', 'name' => 'Company III'],
            ['id' => '2f35f4e9-7ef3-493d-9cc1-afedf85e3457', 'name' => 'Company IV'],
            ['id' => 'fbcdc88d-3666-492f-83ac-44b3398c4f7a', 'name' => 'Company V']
        ];

        foreach ($companies as $company) {
            if (!$this->existsCompany($company['id'])) {
                $model = new Company();
                $model->id = $company['id'];
                $model->name = $company['name'];
                $model->save();
            }
        }
    }

    private function existsCompany(string $id): bool
    {
        $company = Company::find($id);
        return isset($company->id);
    }
}
