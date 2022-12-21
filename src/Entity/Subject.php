<?php

namespace App\Entity;

use App\Repository\SubjectRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SubjectRepository::class)]
class Subject
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $subjectcode = null;

    #[ORM\Column(length: 255)]
    private ?string $subjectname = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSubjectcode(): ?string
    {
        return $this->subjectcode;
    }

    public function setSubjectcode(string $subjectcode): self
    {
        $this->subjectcode = $subjectcode;

        return $this;
    }

    public function getSubjectname(): ?string
    {
        return $this->subjectname;
    }

    public function setSubjectname(string $subjectname): self
    {
        $this->subjectname = $subjectname;

        return $this;
    }
}
