<?php


namespace Talentify\Domain\Recruiter;


interface CreateRecruiterRepositoryInterface
{
    public function create(Recruiter $recruiter): Recruiter;

    public function findByEmail(string $email): ?Recruiter;
}
