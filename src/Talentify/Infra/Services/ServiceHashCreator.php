<?php


namespace Talentify\Infra\Services;


use Talentify\Domain\Services\ServiceHashCreatorInterface;

class ServiceHashCreator implements ServiceHashCreatorInterface
{

    public function create(string $string): string
    {
        return password_hash($string, PASSWORD_ARGON2ID);
    }

    public function verify(string $decrypted, string $encrypted): bool
    {
        return password_verify($decrypted, $encrypted);
    }
}
