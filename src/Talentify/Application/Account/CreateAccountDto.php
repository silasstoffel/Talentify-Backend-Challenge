<?php

namespace Talentify\Application\Account;

class CreateAccountDto
{
    private string $name;
    private string $email;
    private string $password;
    private string $profile;
    private string $key;

    /**
     * CreateAccountDto constructor.
     * @param string $name
     * @param string $email
     * @param string $password
     * @param string $profile
     * @param string $key
     */
    public function __construct(
        string $name,
        string $email,
        string $password,
        string $profile,
        string $key
    )
    {
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->profile = $profile;
        $this->key = $key;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @return string
     */
    public function getProfile(): string
    {
        return $this->profile;
    }

    /**
     * @return string
     */
    public function getKey(): string
    {
        return $this->key;
    }

}
