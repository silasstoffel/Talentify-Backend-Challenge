<?php

use Laravel\Lumen\Testing\DatabaseMigrations;

class LoginControllerTest extends TestCase
{

    use DatabaseMigrations;
    private $recruiter = [];

    protected function setUp(): void
    {
        parent::setUp();

        $this->recruiter = [
            "email" => "silasstofel@gmail.com",
            "name" => "Silas Stoffel",
            "password" => "123456",
            "company_id" => "company1"
        ];

        $this->createFakeCompany();
        $this->seeInDatabase('companies', ['id' => 'company1', 'name' => 'Company 001']);
    }

    public function testShouldAuthenticate()
    {
        $requestHelper = new ApiCommonRequestHelpers();
        $response = $requestHelper->createRecruiterAccount($this, $this->recruiter);
        $response->seeStatusCode(201);

        $response = $this->createLoginRequest($this->recruiter);
        $response->seeStatusCode(200);
    }

    public function testShouldNotAuthenticateWithEmailNonExistent()
    {
        $response = $this->createLoginRequest([
            'email' => 'nonexistents@mail.com',
            'password' => 'invalid',
        ]);
        $response->seeStatusCode(401);
        $response->seeJson(['message' => 'Account not exists.']);
    }

    public function testShouldNotAuthenticateWithInvalidPassword()
    {
        $requestHelper = new ApiCommonRequestHelpers();
        $response = $requestHelper->createRecruiterAccount($this, $this->recruiter);
        $response->seeStatusCode(201);
        $data = array_merge($this->recruiter, ['password' => 'invalid']);
        $response = $this->createLoginRequest($data);

        $response->seeStatusCode(401);
        $response->seeJson(['message' => 'Invalid password.']);
    }

    private function createLoginRequest($data)
    {
        $response = $this->json('POST', '/auth', $data);
        $body = $response->response->getOriginalContent();
        return $response;
    }

    private function createFakeCompany()
    {
        // Create a fake company
        $dbHelper = new TestDbHelpers();
        $dbHelper->createCompany([
            'id' => 'company1', 'name' => 'Company 001'
        ]);
    }

}
