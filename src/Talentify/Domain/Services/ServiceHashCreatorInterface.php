<?php


namespace Talentify\Domain\Services;


interface ServiceHashCreatorInterface
{
    public function create(string $string): string;

    public function verify(string $decrypted, string $encrypted): bool;
}
