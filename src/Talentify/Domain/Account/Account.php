<?php

namespace Talentify\Domain\Account;

class Account
{
    private ?int $id;
    private string $name;
    private Email $email;
    private string $password;
    private string $profile;
    private string $key;

    /**
     * Account constructor.
     * @param int|null $id
     * @param string $name
     * @param Email $email
     * @param string $password
     * @param string $profile
     * @param string $key
     */
    public function __construct(
        ?int $id,
        string $name,
        Email $email,
        string $password,
        string $profile,
        string $key
    )
    {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->profile = $profile;
        $this->key = $key;
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
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
