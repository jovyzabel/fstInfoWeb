<?php

namespace App\Entity;

use App\Repository\IdentificationDocumentRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: IdentificationDocumentRepository::class)]
class IdentificationDocument
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $typeOfDocument = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $identificationNumber = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $dateOfIssue = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $placeOfIssue = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTypeOfDocument(): ?string
    {
        return $this->typeOfDocument;
    }

    public function setTypeOfDocument(?string $typeOfDocument): self
    {
        $this->typeOfDocument = $typeOfDocument;

        return $this;
    }

    public function getIdentificationNumber(): ?string
    {
        return $this->identificationNumber;
    }

    public function setIdentificationNumber(?string $identificationNumber): self
    {
        $this->identificationNumber = $identificationNumber;

        return $this;
    }

    public function getDateOfIssue(): ?\DateTimeInterface
    {
        return $this->dateOfIssue;
    }

    public function setDateOfIssue(?\DateTimeInterface $dateOfIssue): self
    {
        $this->dateOfIssue = $dateOfIssue;

        return $this;
    }

    public function getPlaceOfIssue(): ?string
    {
        return $this->placeOfIssue;
    }

    public function setPlaceOfIssue(?string $placeOfIssue): self
    {
        $this->placeOfIssue = $placeOfIssue;

        return $this;
    }
}
