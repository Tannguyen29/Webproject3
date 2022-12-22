<?php

namespace App\Entity;

use App\Repository\ReportRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ReportRepository::class)]
class Report
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $teachername = null;

    #[ORM\Column(length: 50)]
    private ?string $Classname = null;

    #[ORM\Column(length: 255)]
    private ?string $description = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTeachername(): ?string
    {
        return $this->teachername;
    }

    public function setTeachername(string $teachername): self
    {
        $this->teachername = $teachername;

        return $this;
    }

    public function getClassname(): ?string
    {
        return $this->Classname;
    }

    public function setClassname(string $Classname): self
    {
        $this->Classname = $Classname;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }
}
