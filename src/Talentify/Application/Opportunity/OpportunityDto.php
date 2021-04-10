<?php


namespace Talentify\Application\Opportunity;


class OpportunityDto
{
    private ?string $id;
    private string $title;
    private string $description;
    private string $status;
    private float $salary;
    private string $companyId;
    private string $recruiterId;
    private string $address;

    /**
     * OpportunityDto constructor.
     * @param string|null $id
     * @param string $title
     * @param string $description
     * @param string $status
     * @param float $salary
     * @param string $companyId
     * @param string $recruiterId
     * @param string $address
     */
    public function __construct(?string $id, string $title, string $description, string $status, float $salary, string $companyId, string $recruiterId, string $address)
    {
        $this->id = $id;
        $this->title = $title;
        $this->description = $description;
        $this->status = $status;
        $this->salary = $salary;
        $this->companyId = $companyId;
        $this->recruiterId = $recruiterId;
        $this->address = $address;
    }


    /**
     * @return string|null
     */
    public function getId(): ?string
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
     * @return float
     */
    public function getSalary(): float
    {
        return $this->salary;
    }

    /**
     * @return string
     */
    public function getCompanyId(): string
    {
        return $this->companyId;
    }

    /**
     * @return string
     */
    public function getRecruiterId(): string
    {
        return $this->recruiterId;
    }

    /**
     * @return float
     */
    public function getAddress(): string
    {
        return $this->address;
    }






}
