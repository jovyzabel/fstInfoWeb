<?php

namespace App\Entity;

use App\Repository\PreRegistrationRepository;
use Doctrine\ORM\Mapping as ORM;

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

    #[ORM\OneToOne(mappedBy: 'preRegistration', cascade: ['persist', 'remove'])]
    private ?Student $student = null;

    #[ORM\OneToOne(inversedBy: 'preRegistration', cascade: ['persist', 'remove'])]
    private ?Folder $folder = null;


    #[ORM\Column(length: 255)]
    private ?string $status = null;


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
<

    public function getStudent(): ?Student
    {
        return $this->student;
    }

    public function setStudent(?Student $student): self
    {
        // unset the owning side of the relation if necessary
        if ($student === null && $this->student !== null) {
            $this->student->setPreRegistration(null);
        }

        // set the owning side of the relation if necessary
        if ($student !== null && $student->getPreRegistration() !== $this) {
            $student->setPreRegistration($this);
        }

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

}
