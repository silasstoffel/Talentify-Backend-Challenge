<?php


namespace Talentify\Domain\Recruiter;

use Talentify\Domain\Email;
use Talentify\Domain\Company\Company;

class Recruiter
{
    private ?int $id;
    private string $name;
    private Email $email;
    private Company $company;

    /**
     * Recruiter constructor.
     * @param int|null $id
     * @param string $name
     * @param Email $email
     * @param Company $company
     */
    public function __construct(
        ?int $id,
        string $name,
        Email $email,
        Company $company
    )
    {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->company = $company;
    }

    public static function createWithString(
        ?int $recruiterId,
        string $recruiterName,
        string $recruiterEmail,
        string $companyName,
        ?int $companyId = null
    )
    {
        $company = new Company($companyId, $companyName);
        $email = new Email($recruiterEmail);
        return new Recruiter(
            $recruiterId,
            $recruiterName,
            $email,
            $company
        );
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
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
     * @return Email
     */
    public function getEmail(): Email
    {
        return $this->email;
    }

    /**
     * @return Company
     */
    public function getCompany(): Company
    {
        return $this->company;
    }

}
