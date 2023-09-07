<?php

namespace App\Entity;

use App\Repository\StudentRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: StudentRepository::class)]
class Student extends Person
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $birthDay = null;

    #[ORM\Column(length: 255)]
    private ?string $birthPlace = null;

    #[ORM\Column(length: 255)]
    private ?string $telephone = null;

    #[ORM\Column(length: 255)]
    private ?string $email = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?Address $address = null;

    #[ORM\OneToOne(mappedBy: 'student', cascade: ['persist', 'remove'])]
    private ?PreRegistration $preRegistration = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?IdentificationDocument $identificationDocument = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $marriedName = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?ContactPerson $contactPerson = null;

    #[ORM\Column(length: 255)]
    private ?string $lastSchool = null;

    #[ORM\Column(length: 255)]
    private ?string $lastDiploma = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $job = null;

    #[ORM\Column(length: 255)]
    private ?string $status = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBirthDay(): ?\DateTimeInterface
    {
        return $this->birthDay;
    }

    public function setBirthDay(\DateTimeInterface $birthDay): self
    {
        $this->birthDay = $birthDay;

        return $this;
    }

    public function getBirthPlace(): ?string
    {
        return $this->birthPlace;
    }

    public function setBirthPlace(string $birthPlace): self
    {
        $this->birthPlace = $birthPlace;

        return $this;
    }

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(string $telephone): self
    {
        $this->telephone = $telephone;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getAddress(): ?Address
    {
        return $this->address;
    }

    public function setAddress(?Address $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getPreRegistration(): ?PreRegistration
    {
        return $this->preRegistration;
    }

    public function setPreRegistration(?PreRegistration $preRegistration): self
    {
        // unset the owning side of the relation if necessary
        if ($preRegistration === null && $this->preRegistration !== null) {
            $this->preRegistration->setStudent(null);
        }

        // set the owning side of the relation if necessary
        if ($preRegistration !== null && $preRegistration->getStudent() !== $this) {
            $preRegistration->setStudent($this);
        }

        $this->preRegistration = $preRegistration;

        return $this;
    }

    public function getIdentificationDocument(): ?IdentificationDocument
    {
        return $this->identificationDocument;
    }

    public function setIdentificationDocument(?IdentificationDocument $identificationDocument): self
    {
        $this->identificationDocument = $identificationDocument;

        return $this;
    }

    public function getMarriedName(): ?string
    {
        return $this->marriedName;
    }

    public function setMarriedName(?string $marriedName): self
    {
        $this->marriedName = $marriedName;

        return $this;
    }

    public function getContactPerson(): ?ContactPerson
    {
        return $this->contactPerson;
    }

    public function setContactPerson(ContactPerson $contactPerson): self
    {
        $this->contactPerson = $contactPerson;

        return $this;
    }

    public function getLastSchool(): ?string
    {
        return $this->lastSchool;
    }

    public function setLastSchool(string $lastSchool): self
    {
        $this->lastSchool = $lastSchool;

        return $this;
    }

    public function getLastDiploma(): ?string
    {
        return $this->lastDiploma;
    }

    public function setLastDiploma(string $lastDiploma): self
    {
        $this->lastDiploma = $lastDiploma;

        return $this;
    }

    public function getJob(): ?string
    {
        return $this->job;
    }

    public function setJob(?string $job): self
    {
        $this->job = $job;

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

}
