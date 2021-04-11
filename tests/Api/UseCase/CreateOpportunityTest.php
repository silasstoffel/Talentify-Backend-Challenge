<?php

use Laravel\Lumen\Testing\DatabaseMigrations;

class CreateOpportunityTest extends TestCase
{

    use DatabaseMigrations;

    private $recruiter = [];
    private $opportunity = [
        "title" => "NodeJS Enginer",
        "description" => "NodeJS Developer",
        "status" => "opened",
        "salary"=> 10000.00,
        "address" => "Vitoria - ES"
    ];

    protected function setUp(): void
    {
        parent::setUp();
        $this->_login    = 'r1@gmail.com';
        $this->_password = '123456';
        $this->recruiter = [
            "email" => $this->_login,
            "name" => "Recruiter1",
            "password" => $this->_password,
            "company_id" => "company1"
        ];
    }

    public function testShouldCreateOpportunity()
    {
        $this->createCompany();

        $requestHelper = new ApiCommonRequestHelpers();
        $requestHelper->createRecruiterAccount($this, $this->recruiter);

        $response = $this->createOpportunity($this->opportunity);
        $response->seeStatusCode(201);
        $response->seeJsonContains([
            "title" => "NodeJS Enginer",
            "description" => "NodeJS Developer",
            "status" => "opened",
            "salary"=> 10000.00,
            "address" => "Vitoria - ES",
            'company_id' => 'company1',
        ]);
    }

    public function testShouldNotCreateOpportunityWithInvalidStatus()
    {
        $this->createCompany();
        $requestHelper = new ApiCommonRequestHelpers();
        $requestHelper->createRecruiterAccount($this, $this->recruiter);
        $data = array_merge($this->opportunity, ['status' => 'invalid']);
        $response = $this->createOpportunity($data);
        $response->seeStatusCode(400);
        $response->seeJsonContains(["message" => "Invalid status."]);
    }

    private function createOpportunity($data) {
        $payload  = $data;
        $headers  = $this->createToken();
        $response = $this->json('POST', '/v1/opportunities', $payload, $headers);
        return $response;
    }

    private function createCompany() {
        $dbHelper = new TestDbHelpers();
        $dbHelper->createCompany([
            'id' => 'company1', 'name' => 'Company 001'
        ]);
    }

}
