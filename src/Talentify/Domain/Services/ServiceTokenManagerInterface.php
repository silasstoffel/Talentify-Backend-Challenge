<?php


namespace Talentify\Domain\Services;


use stdClass;

interface ServiceTokenManagerInterface
{
    public function create(array $data): string;
    public function decode(string $token): ?stdClass;
}
