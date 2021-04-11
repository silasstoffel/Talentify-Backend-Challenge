<?php


namespace Talentify\Application\Opportunity;


class DeleteOportunityDto
{
    private string $id;
    private string $recruiterId;

    /**
     * DeleteOportunityDto constructor.
     * @param string $id
     * @param string $recruiterId
     */
    public function __construct(string $id, string $recruiterId)
    {
        $this->id = $id;
        $this->recruiterId = $recruiterId;
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
    public function getRecruiterId(): string
    {
        return $this->recruiterId;
    }

}
