<?php

namespace App\Entity;

use App\Repository\LastCurriculumRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LastCurriculumRepository::class)]
class LastCurriculum
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(length: 255)]
    private ?string $semesterOneValidationYear = null;

    #[ORM\Column]
    private ?float $semesterOneAverage = null;

    #[ORM\Column(length: 255)]
    private ?string $school = null;

    #[ORM\Column(length: 255)]
    private ?string $semesterOneValidationSession = null;

    #[ORM\Column(length: 255)]
    private ?string $semesterTwoValidationSession = null;

    #[ORM\Column]
    private ?float $semesterTwoAverage = null;

    #[ORM\Column(length: 255)]
    private ?string $semesterTwoValidationYear = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getSemesterOneValidationYear(): ?string
    {
        return $this->semesterOneValidationYear;
    }

    public function setSemesterOneValidationYear(string $semesterOneValidationYear): self
    {
        $this->semesterOneValidationYear = $semesterOneValidationYear;

        return $this;
    }

    public function getSemesterOneAverage(): ?float
    {
        return $this->semesterOneAverage;
    }

    public function setSemesterOneAverage(float $semesterOneAverage): self
    {
        $this->semesterOneAverage = $semesterOneAverage;

        return $this;
    }

    public function getSchool(): ?string
    {
        return $this->school;
    }

    public function setSchool(string $school): self
    {
        $this->school = $school;

        return $this;
    }

    public function getSemesterOneValidationSession(): ?string
    {
        return $this->semesterOneValidationSession;
    }

    public function setSemesterOneValidationSession(string $semesterOneValidationSession): self
    {
        $this->semesterOneValidationSession = $semesterOneValidationSession;

        return $this;
    }

    public function getSemesterTwoValidationSession(): ?string
    {
        return $this->semesterTwoValidationSession;
    }

    public function setSemesterTwoValidationSession(string $semesterTwoValidationSession): self
    {
        $this->semesterTwoValidationSession = $semesterTwoValidationSession;

        return $this;
    }

    public function getSemesterTwoAverage(): ?float
    {
        return $this->semesterTwoAverage;
    }

    public function setSemesterTwoAverage(float $semesterTwoAverage): self
    {
        $this->semesterTwoAverage = $semesterTwoAverage;

        return $this;
    }

    public function getSemesterTwoValidationYear(): ?string
    {
        return $this->semesterTwoValidationYear;
    }

    public function setSemesterTwoValidationYear(string $semesterTwoValidationYear): self
    {
        $this->semesterTwoValidationYear = $semesterTwoValidationYear;

        return $this;
    }
}
