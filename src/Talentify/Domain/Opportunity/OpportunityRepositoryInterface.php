<?php


namespace Talentify\Domain\Opportunity;

interface OpportunityRepositoryInterface
{
    public function findById(string $id): ?Opportunity;

    public function findByRecruiterId(string $recruiterId): ?array;

    public function create(Opportunity $opportunity): Opportunity;

    public function update(Opportunity $opportunity, string $id): Opportunity;

    public function findAll(array $filters = []): array;

    public function delete(string $id): void;
}
