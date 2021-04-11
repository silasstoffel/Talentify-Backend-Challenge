<?php

use Laravel\Lumen\Testing\DatabaseMigrations;

class UpdateOpportunityTest extends TestCase
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

    public function testShouldUpdateOpportunity()
    {
        $this->createCompany();

        $requestHelper = new ApiCommonRequestHelpers();
        $requestHelper->createRecruiterAccount($this, $this->recruiter);

        // Create
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
        $bodyCreate = $response->response->getOriginalContent();
        $id = $bodyCreate['id'];

        // update
        $this->opportunity['title'] = 'PHP Senior Developer';
        $this->opportunity['salary'] = 12000.00;
        $response = $this->updateOpportunity($this->opportunity, $id);
        $response->seeStatusCode(200);
        $response->seeJsonContains([
            "title" => $this->opportunity['title'],
            "id" => $id,
            "salary" => $this->opportunity['salary'] = 12000.00
        ]);
    }

    public function testShouldNotChangeWithoutAuthenticating()
    {
        $endpoint = '/v1/opportunities/102030';
        $headers = ['Authorization' => 'Bearer'];;
        $response = $this->json('PUT', $endpoint, [], $headers);
        $response->seeStatusCode(401);
        $response->seeJsonContains(['message' => 'Unauthorized.']);
    }

    private function createOpportunity($data) {
        $payload  = $data;
        $headers  = $this->createToken();
        $response = $this->json('POST', '/v1/opportunities', $payload, $headers);
        return $response;
    }

    private function updateOpportunity($data, $id) {
        $payload  = $data;
        $headers  = $this->createToken();
        $endpoint = '/v1/opportunities/' . $id;
        $response = $this->json('PUT', $endpoint, $payload, $headers);
        return $response;
    }

    private function createCompany($index = '1') {
        $dbHelper = new TestDbHelpers();
        $dbHelper->createCompany([
            'id' => 'company' . $index,
            'name' => 'Company' . $index
        ]);
    }
}
