<?php


namespace Talentify\Application\Jobs;


class SearchJobsDto
{
    private ?string $address;
    private ?string $salary;
    private ?string $companyName;
    private ?string $keyword;
    private array $status;

    /**
     * SearchJobsDto constructor.
     * @param string|null $address
     * @param string|null $salary
     * @param string|null $companyName
     * @param string|null $keyword
     */
    public function __construct(?string $address, ?string $salary, ?string $companyName, ?string $keyword, array $status = ['*'])
    {
        $this->address = $address;
        $this->salary = $salary;
        $this->companyName = $companyName;
        $this->keyword = $keyword;
        $this->status = $status;
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
    public function getCompanyName(): ?string
    {
        return $this->companyName;
    }

    /**
     * @return string|null
     */
    public function getKeyword(): ?string
    {
        return $this->keyword;
    }

    /**
     * @return array
     */
    public function getStatus(): array
    {
        return $this->status;
    }
}
