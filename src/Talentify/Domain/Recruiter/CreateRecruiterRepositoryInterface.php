<?php


namespace Talentify\Domain\Recruiter;


interface CreateRecruiterRepositoryInterface
{
    public function create(Recruiter $recruiter): Recruiter;
}
