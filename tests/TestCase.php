<?php

use Laravel\Lumen\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{

    protected $_login    = '';
    protected $_password = '';

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
        $data = ['login' => $this->_login, 'password' => $this->_password];
        $response = $this->json('POST', '/auth', $data);

        $body = $response->response->getOriginalContent();
        $token = isset($body['token']) ? $body['token'] : null;

        return ['Authorization' => 'Bearer ' . $token];
    }
}
