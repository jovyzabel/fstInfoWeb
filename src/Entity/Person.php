<?php

namespace App\Entity;

use DateTime;
use DateTimeImmutable;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\PersonRepository;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Validator\Constraints as Assert;


#[ORM\MappedSuperclass()]
#[Vich\Uploadable]
class Person
{

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: 'Veuillez entrer votre Nom')]
    #[Assert\Length(min: 2,
        max: 50,
        minMessage: 'Votre nom doit avoir au moins {{ limit }} caractères',
    )]
    #[Assert\Regex([
        'pattern' => '/\d/',
        'match' => false,
        'message' => 'Votre prénom ne doit pas contenir un nombre',
    ]),]
    protected ?string $name = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank()]
    #[Assert\Length(min: 2,
        max: 50,
        minMessage: 'Votre nom doit avoir au moins {{ limit }} caractères',
    )]
    #[Assert\Regex([
        'pattern' => '/\d/',
        'match' => false,
        'message' => 'Votre prénom ne doit pas contenir un nombre',
    ]),]
    protected ?string $firstName = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    protected ?Account $account = null;

    #[ORM\Column(length: 255)]
    private ?string $pictureName = null;

    #[Vich\UploadableField(mapping: 'person_pictures', fileNameProperty: 'pictureName')]
    protected ?File $pictureFile = null;

    #[ORM\Column]
    protected ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column(length: 40)]
    #[Assert\Choice(['Monsieur', 'Madame'])]
    private ?string $civility = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $updatedAt = null;

    public function __construct( ){
        $this->createdAt = new DateTimeImmutable();
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

    public function getPictureFile()
    {
        return $this->pictureFile;
    }

    public function setPictureFile(File $pictureFile)
    {
        $this->pictureFile = $pictureFile;

        if (null !== $pictureFile) {

            $this->updatedAt = new \DateTime();
        }

        return $this;
    }

    public function getPictureName():?string
    {
        return $this->pictureName;
    }

    public function setPictureName($pictureName):self
    {
        $this->pictureName = $pictureName;

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

    public function getUpdatedAt(): ?\DateTime
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTime $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getCivility(): ?string
    {
        return $this->civility;
    }

    public function setCivility(string $civility): self
    {
        $this->civility = $civility;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

}
