<?php


namespace Talentify\Application\Jobs;


class SearchJobsDto
{
    public ?string $address;
    public ?string $salary;
    public ?string $company;
    public ?string $keyword;

    /**
     * SearchJobsDto constructor.
     * @param string|null $address
     * @param string|null $salary
     * @param string|null $company
     * @param string|null $keyword
     */
    public function __construct(?string $address, ?string $salary, ?string $company, ?string $keyword)
    {
        $this->address = $address;
        $this->salary = $salary;
        $this->company = $company;
        $this->keyword = $keyword;
    }

    /**
     * @return string|null
     */
    public function getAddress(): ?string
    {
        return $this->address;
    }

    /**
     * @return string|null
     */
    public function getSalary(): ?string
    {
        return $this->salary;
    }

    /**
     * @return string|null
     */
    public function getCompany(): ?string
    {
        return $this->company;
    }

    /**
     * @return string|null
     */
    public function getKeyword(): ?string
    {
        return $this->keyword;
    }
}
