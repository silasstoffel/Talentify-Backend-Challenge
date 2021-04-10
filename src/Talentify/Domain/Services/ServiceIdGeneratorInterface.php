<?php

namespace Talentify\Domain\Services;


interface ServiceIdGeneratorInterface
{
    public function create(): string;
}
