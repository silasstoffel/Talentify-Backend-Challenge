<?php


namespace Talentify\Domain\Recruiter;


interface RecruiterRepositoryInterface
{
    public function create(Recruiter $recruiter): Recruiter;

    public function findByEmail(string $email): ?Recruiter;

    public function findById(string $id);
}
