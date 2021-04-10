<?php


namespace Talentify\Infra\Services;


use Ramsey\Uuid\Uuid;
use Talentify\Domain\Services\ServiceIdGeneratorInterface;

class UuidCreator implements ServiceIdGeneratorInterface
{
    public function create(): string
    {
        return Uuid::uuid4();
    }
}
