<?php


namespace Talentify\Application\Recruiter;


class CreateRecruiterDto
{
    private ?string $id = null;
    private string $name;
    private string $email;
    private string $companyId;

    /**
     * CreateRecruiterDto constructor.
     * @param string $name
     * @param string $email
     * @param string $companyId
     */
    public function __construct(?string $id, string $name, string $email, string $companyId)
    {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->companyId = $companyId;
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
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getCompanyId(): string
    {
        return $this->companyId;
    }

}
