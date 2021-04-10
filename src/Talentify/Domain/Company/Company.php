<?php


namespace Talentify\Domain\Company;


class Company
{
    private ?string $id;
    private string $name;

    /**
     * Company constructor.
     * @param int|null $id
     * @param string $name
     */
    public function __construct(?string $id, string $name)
    {
        $this->id = $id;
        $this->name = $name;
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
    public function getName(): string
    {
        return $this->name;
    }
}
