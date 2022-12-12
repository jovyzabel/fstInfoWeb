<?php

namespace App\Entity;

use App\Repository\SubjectRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SubjectRepository::class)]
class Subject
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $label = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\ManyToOne(inversedBy: 'subjects')]
    private ?UE $ue = null;

    #[ORM\ManyToOne(inversedBy: 'teachedSubjects')]
    private ?Teacher $teacher = null;

    #[ORM\Column(nullable: true)]
    private ?float $credits = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function setLabel(string $label): self
    {
        $this->label = $label;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getUe(): ?UE
    {
        return $this->ue;
    }

    public function setUe(?UE $ue): self
    {
        $this->ue = $ue;

        return $this;
    }

    public function getTeacher(): ?Teacher
    {
        return $this->teacher;
    }

    public function setTeacher(?Teacher $teacher): self
    {
        $this->teacher = $teacher;

        return $this;
    }

    public function __toString()
    {
        return $this->label;
    }

    public function getCredits(): ?float
    {
        return $this->credits;
    }

    public function setCredits(?float $credits): self
    {
        $this->credits = $credits;

        return $this;
    }
}
