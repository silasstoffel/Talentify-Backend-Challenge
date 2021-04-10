<?php

namespace Talentify\Domain\Opportunity;

use DomainException;
use Talentify\Domain\Company\Company;
use Talentify\Domain\Recruiter\Recruiter;

class Opportunity
{
    const STATUS_OPEN = 'open';
    const STATUS_FINISHED = 'finished';
    const STATUS_INACTIVE = 'inactive';

    private ?string $id;
    private string $title;
    private string $description;
    private string $status;
    private string $address;
    private float $salary;
    private Company $company;
    private Recruiter $recruiter;

    /**
     * Opportunity constructor.
     * @param ?string $id ID
     * @param string $title Title
     * @param string $description description
     * @param string $status status (open, finished, inactive)
     * @param string $address address
     * @param float $salary value of salary
     * @param Company $company company
     * @param Recruiter $recruiter recruiter
     */
    public function __construct(
        ?string $id,
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
        $this->setTitle($title);
        $this->description = $description;
        $this->setAddress($address);
        $this->setSalary($salary);
        $this->company = $company;
        $this->recruiter = $recruiter;
    }

    /**
     * @return string
     */
    public function getId(): string
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
     * @param string $title
     */
    public function setTitle(string $title): void
    {
        if (!strlen(trim($title))) {
            throw new DomainException('Title is required.', 400);
        }
        $this->title = $title;
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
     * @param string $address
     */
    public function setAddress(string $address): void
    {
        if (!strlen(trim($address))) {
            throw new DomainException('Address is required.', 400);
        }
        $this->address = $address;
    }

    /**
     * @return float
     */
    public function getSalary(): float
    {
        return $this->salary;
    }

    /**
     * @param float $salary
     */
    public function setSalary(float $salary): void
    {
        if (!$salary) {
            throw new DomainException('Salary must be greater than 0.', 400);
        }
        $this->salary = $salary;
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
