<?php

namespace App\Entity;

use App\Repository\EmployeeRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EmployeeRepository::class)
 */
class Employee
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $nameSurname;

    /**
     * @ORM\Column(type="integer")
     */
    private $workPerHour;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNameSurname(): ?string
    {
        return $this->nameSurname;
    }

    public function setNameSurname(string $nameSurname): self
    {
        $this->nameSurname = $nameSurname;

        return $this;
    }

    public function getWorkPerHour(): ?int
    {
        return $this->workPerHour;
    }

    public function setWorkPerHour(int $workPerHour): self
    {
        $this->workPerHour = $workPerHour;

        return $this;
    }
}
