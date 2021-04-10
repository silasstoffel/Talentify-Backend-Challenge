<?php

namespace Talentify\Domain\Account;

use DomainException;
use Talentify\Domain\Email;

class Account
{
    private ?string $id = null;
    private string $name;
    private Email $email;
    private ?string $password = null;
    private string $profile;
    private string $key;

    /**
     * Account constructor.
     * @param string $id
     * @param string $name
     * @param Email $email
     * @param string $password
     * @param string $profile
     * @param string $key
     */
    public function __construct(
        ?string $id,
        string $name,
        Email $email,
        string $password,
        string $profile,
        string $key
    )
    {
        $this->id = $id;
        $this->setName($name);
        $this->email = $email;
        $this->setPassword($password);
        $this->profile = $profile;
        $this->key = $key;
    }

    /**
     * @return null|string
     */
    public function getId(): ?string
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name name
     */
    private function setName(string $name): void
    {
        if (!strlen($name)) {
            throw new DomainException('Name is required.', 400);
        }
        $this->name = $name;
    }


    /**
     * @return Email
     */
    public function getEmail(): Email
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
     * @param string $password password
     */
    private function setPassword(string $password): void
    {
        if (strlen($this->getId()) && empty($password)) {
            throw new DomainException('Password is required.', 400);
        }
        $this->password = $password;
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
