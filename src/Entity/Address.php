<?php

namespace App\Entity;

use App\Repository\AddressRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: AddressRepository::class)]
class Address
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $street_name = null;

    #[ORM\Column(nullable: true)]
    private ?int $street_number = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Assert\Length(min: 2,)]
    #[Assert\Regex([
        'pattern' => '/\d/',
        'match' => false,
        'message' => 'Entrez un lieu exact',
    ]),]
    private ?string $quater_name = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $city = null;

    #[ORM\Column(length: 255)]
    private ?string $country = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStreetName(): ?string
    {
        return $this->street_name;
    }

    public function setStreetName(?string $street_name): self
    {
        $this->street_name = $street_name;

        return $this;
    }

    public function getStreetNumber(): ?int
    {
        return $this->street_number;
    }

    public function setStreetNumber(?int $street_number): self
    {
        $this->street_number = $street_number;

        return $this;
    }

    public function getQuaterName(): ?string
    {
        return $this->quater_name;
    }

    public function setQuaterName(?string $quater_name): self
    {
        $this->quater_name = $quater_name;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(?string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(string $country): self
    {
        $this->country = $country;

        return $this;
    }
}
