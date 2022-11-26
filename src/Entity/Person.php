<?php

namespace App\Entity;

use App\Repository\PersonRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\MappedSuperclass()]
class Person
{

    #[ORM\Column(length: 255)]
    protected ?string $name = null;

    #[ORM\Column(length: 255)]
    protected ?string $firstName = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    protected ?Account $account = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getAccount(): ?Account
    {
        return $this->account;
    }

    public function setAccount(?Account $account): self
    {
        $this->account = $account;

        return $this;
    }

    public function __toString()
    {
        return $this->name .' '.$this->firstName;
    }
}
