<?php

use Laravel\Lumen\Testing\DatabaseMigrations;

class DeleteOpportunityTest extends TestCase
{

    use DatabaseMigrations;
    private $id;
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

    public function testShouldDeleteOpportunity()
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

        // delete
        $response = $this->deleteOpportunity($id);
        $response->seeStatusCode(204);
    }

    public function testShouldNotDeleteOpportunityCaseNotFound()
    {
        $this->createCompany();

        $requestHelper = new ApiCommonRequestHelpers();
        $requestHelper->createRecruiterAccount($this, $this->recruiter);

        $response = $this->deleteOpportunity('uuid-not-found');
        $response->seeStatusCode(400);
        $response->seeJsonContains(['message' => 'Opportunity not found.']);
    }

    public function testShouldNotDeleteWithoutAuthenticating()
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

    private function deleteOpportunity($id) {
        $headers  = $this->createToken();
        $endpoint = '/v1/opportunities/' . $id;
        return $this->json('DELETE', $endpoint, [], $headers);
    }

    private function createCompany($index = '1') {
        $dbHelper = new TestDbHelpers();
        $dbHelper->createCompany([
            'id' => 'company' . $index,
            'name' => 'Company' . $index
        ]);
    }
}
