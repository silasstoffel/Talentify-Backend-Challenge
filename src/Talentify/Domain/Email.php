<?php


namespace Talentify\Domain;


class Email
{
    private string $address;

    public function __construct(string $address)
    {
        if (filter_var($address, FILTER_VALIDATE_EMAIL) === false) {
            throw new \DomainException('Invalid e-mail address.', 400);
        }

        $this->address = $address;
    }

    public function __toString(): string
    {
        return $this->address;
    }
}
