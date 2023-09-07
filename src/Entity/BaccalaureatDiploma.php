<?php

namespace App\Entity;

use App\Repository\BaccalaureatDiplomaRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BaccalaureatDiplomaRepository::class)]
class BaccalaureatDiploma
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $serie = null;

    #[ORM\Column(length: 255)]
    private ?string $titled = null;

    #[ORM\Column(length: 255)]
    private ?string $year = null;

    #[ORM\Column(length: 255)]
    private ?string $placeOfAcquisition = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSerie(): ?string
    {
        return $this->serie;
    }

    public function setSerie(string $serie): self
    {
        $this->serie = $serie;

        return $this;
    }

    public function getTitled(): ?string
    {
        return $this->titled;
    }

    public function setTitled(string $titled): self
    {
        $this->titled = $titled;

        return $this;
    }

    public function getYear(): ?string
    {
        return $this->year;
    }

    public function setYear(string $year): self
    {
        $this->year = $year;

        return $this;
    }

    public function getPlaceOfAcquisition(): ?string
    {
        return $this->placeOfAcquisition;
    }

    public function setPlaceOfAcquisition(string $placeOfAcquisition): self
    {
        $this->placeOfAcquisition = $placeOfAcquisition;

        return $this;
    }
}
