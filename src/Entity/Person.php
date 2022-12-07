<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\PersonRepository;
use DateTimeImmutable;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;


#[ORM\MappedSuperclass()]
#[Vich\Uploadable]
class Person
{

    #[ORM\Column(length: 255)]
    protected ?string $name = null;

    #[ORM\Column(length: 255)]
    protected ?string $firstName = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    protected ?Account $account = null;

    #[ORM\Column(length: 255)]
    private ?string $avatarName = null;

    #[Vich\UploadableField(mapping: 'person_avatars', fileNameProperty: 'avatarName')]
    private ?File $avatarFile = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $updatedAt = null;

    public function __construct( ){
        $this->createdAt = new DateTimeImmutable();
    }

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

    public function getAvatarFile()
    {
        return $this->avatarFile;
    }

    public function setAvatarFile(File $avatarFile)
    {
        $this->avatarFile = $avatarFile;

        if (null !== $avatarFile) {

            $this->updatedAt = new \DateTimeImmutable();
        }

        return $this;
    }

    public function getAvatarName():?string
    {
        return $this->avatarName;
    }

    public function setAvatarName($avatarName):self
    {
        $this->avatarName = $avatarName;

        return $this;
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

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeImmutable $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }
}
