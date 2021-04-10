<?php


namespace Talentify\Domain\Services;


interface ServiceTokenManagerInterface
{
    public function create(array $data): string;
    //public function isValid(): bool;
}
