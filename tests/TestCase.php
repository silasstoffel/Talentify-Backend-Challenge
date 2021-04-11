<?php

use Laravel\Lumen\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{

    protected $_login    = '';
    protected $_password = '';
    private ?string $token = null;

    /**
     * Creates the application.
     *
     * @return \Laravel\Lumen\Application
     */
    public function createApplication()
    {
        return require __DIR__ . '/../bootstrap/app.php';
    }

    protected function createToken()
    {
        $this->token = null;
        $data = ['email' => $this->_login, 'password' => $this->_password];
        $response = $this->json('POST', '/auth', $data);

        $body = $response->response->getOriginalContent();
        $token = $body['token'] ?? null;
        $this->token = $token;
        return ['Authorization' => 'Bearer ' . $token];
    }

    protected function getCurrentToken() {
        return $this->token;
    }
}
