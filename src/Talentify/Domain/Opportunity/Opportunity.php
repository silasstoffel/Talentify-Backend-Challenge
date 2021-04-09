<?php

namespace Talentify\Domain\Opportunity;

use DomainException;
use Talentify\Domain\Company\Company;

class Opportunity
{
    const STATUS_OPEN = 'open';
    const STATUS_FINISHED = 'finished';
    const STATUS_INACTIVE = 'inactive';

    private ?int $id;
    private string $title;
    private string $description;
    private string $status;
    private string $address;
    private float $salary;
    private Company $company;
    private Recruiter $recruiter;

    /**
     * Opportunity constructor.
     * @param ?int $id ID
     * @param string $title Title
     * @param string $description description
     * @param string $status status (open, finished, inactive)
     * @param string $address address
     * @param float $salary value of salary
     * @param Company $company company
     * @param Recruiter $recruiter recruiter
     */
    public function __construct(
        ?int $id,
        string $title,
        string $description,
        string $status,
        string $address,
        float $salary,
        Company $company,
        Recruiter $recruiter
    )
    {
        $this->setStatus($status);
        $this->id = $id;
        $this->title = $title;
        $this->description = $description;
        $this->address = $address;
        $this->salary = $salary;
        $this->company = $company;
        $this->recruiter = $recruiter;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @return string
     */
    public function getAddress(): string
    {
        return $this->address;
    }

    /**
     * @return float
     */
    public function getSalary(): float
    {
        return $this->salary;
    }

    /**
     * @return Company
     */
    public function getCompany(): Company
    {
        return $this->company;
    }

    /**
     * @return Recruiter
     */
    public function getRecruiter(): Recruiter
    {
        return $this->recruiter;
    }

    private function setStatus($status)
    {
        $options = [
            Opportunity::STATUS_OPEN,
            Opportunity::STATUS_FINISHED,
            Opportunity::STATUS_INACTIVE
        ];

        if (!in_array($status, $options)) {
            throw new DomainException('Invalid status.', 400);
        }
        $this->status = $status;
    }

}
