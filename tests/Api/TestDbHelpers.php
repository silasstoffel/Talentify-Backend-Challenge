<?php

use App\Models\Company;

final class TestDbHelpers
{
    public function createCompany(array $data) {
        return Company::create($data);
    }
}
