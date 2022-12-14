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

    #[ORM\Column(length: 100)]
    #[Assert\Length(min: 2,)]
    #[Assert\Regex([
        'pattern' => '/\d/',
        'match' => false,
        'message' => 'Entrez un lieu exact',
    ]),]
    private ?string $birthPlace = null;

    #[ORM\Column(length: 40)]
    #[Assert\Length(
        min: 9,
        max: 9,  
        exactMessage: 'Vous numéro ne doit contenir que {{ limit }} chiffres',
    )]
    private ?string $telephone = null;
    #[ORM\Column(length: 255, nullable: true)]
    #[Assert\Email(
        message :" la {{ value }} de votre Email n'est pas correct "    
    )]
    private ?string $email = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?Address $address = null;

    #[ORM\OneToOne(inversedBy: 'student', cascade: ['persist', 'remove'])]
    private ?PreRegistration $preRegistration = null;

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
        $this->preRegistration = $preRegistration;

        return $this;
    }
}
