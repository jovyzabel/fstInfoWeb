<?php

namespace App\Entity;

use DateTimeImmutable;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\PreRegistrationRepository;

#[ORM\Entity(repositoryClass: PreRegistrationRepository::class)]
class PreRegistration
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;
    
    #[ORM\Column(length: 255)]
    private ?string $status = null;

    #[ORM\OneToOne(inversedBy: 'preRegistration', cascade: ['persist', 'remove'])]
    private ?Student $student = null;

    #[ORM\OneToOne(inversedBy: 'preRegistration', cascade: ['persist', 'remove'])]
    private ?Folder $folder = null;

    #[ORM\ManyToOne(inversedBy: 'preRegistrations')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Speciality $speciality = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?AcademicYear $academicYear = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $preRegistrationType = null;

    public function __construct()
    {
        $this->createdAt = new DateTimeImmutable();
        $this->status = '';
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }

    function __toString()
    {
        return "Préinscription";
    }

    public function getStudent(): ?Student
    {
        return $this->student;
    }

    public function setStudent(?Student $student): self
    {
        $this->student = $student;

        return $this;
    }

    public function getFolder(): ?Folder
    {
        return $this->folder;
    }

    public function setFolder(?Folder $folder): self
    {
        $this->folder = $folder;

        return $this;
    }

    public function getSpeciality(): ?Speciality
    {
        return $this->speciality;
    }

    public function setSpeciality(?Speciality $speciality): self
    {
        $this->speciality = $speciality;

        return $this;
    }

    public function getAcademicYear(): ?AcademicYear
    {
        return $this->academicYear;
    }

    public function setAcademicYear(?AcademicYear $academicYear): self
    {
        $this->academicYear = $academicYear;

        return $this;
    }

    public function getPreRegistrationType(): ?string
    {
        return $this->preRegistrationType;
    }

    public function setPreRegistrationType(?string $preRegistrationType): self
    {
        $this->preRegistrationType = $preRegistrationType;

        return $this;
    }
}
