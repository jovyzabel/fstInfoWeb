<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\FolderRepository;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Validator\Constraints as Assert;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

#[ORM\Entity(repositoryClass: FolderRepository::class)]
#[Vich\Uploadable]
class Folder
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;
    
    #[ORM\Column(length: 255)]
    private ?string $attestationOfValidation = null;

    #[Assert\File(
        maxSize: '1024k',
        mimeTypes: ['application/pdf', 'application/x-pdf'],
        mimeTypesMessage: 'Please upload a valid PDF',
    )]
    #[Vich\UploadableField(mapping: 'enrolement_documents', fileNameProperty: 'attestationOfValidation')]
    private ?File $attestationOfValidationFile = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $degree = null;
    
    #[Vich\UploadableField(mapping: 'enrolement_documents', fileNameProperty: 'degree')]
    private ?File $degreeFile = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $bulletin = null;
    

    #[Vich\UploadableField(mapping: 'enrolement_documents', fileNameProperty: 'bulletin')]
    private ?File $bulletinFile = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $letter = null;

    #[ORM\OneToOne(mappedBy: 'folder', cascade: ['persist', 'remove'])]
    private ?PreRegistration $preRegistration = null;

    public function getId(): ?int
    {
        return $this->id;
    }


    public function getAttestationOfValidationFile(): ?File
    {
        return $this->attestationOfValidationFile;
    }

    public function setAttestationOfValidationFile(?File $attestationOfValidationFile = null): void
    {
        $this->attestationOfValidationFile = $attestationOfValidationFile;

        if (null !== $attestationOfValidationFile) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTimeImmutable();
        }
    }

    public function getAttestationOfValidation(): ?string
    {
        return $this->attestationOfValidation;
    }

    public function setAttestationOfValidation(string $attestationOfValidation): self
    {
        $this->attestationOfValidation = $attestationOfValidation;

        return $this;
    }

    
    public function getDegreeFile(): ?File
    {
        return $this->degreeFile;
    }

    public function setDegreeFile(?File $degreeFile = null): void
    {
        $this->degreeFile = $degreeFile;

        if (null !== $degreeFile) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTimeImmutable();
        }
    }


    public function getDegree(): ?string
    {
        return $this->degree;
    }

    public function setDegree(?string $degree): self
    {
        $this->degree = $degree;

        return $this;
    }

    public function getBulletinFile(): ?File
    {
        return $this->bulletinFile;
    }

    public function setBulletinFile(?File $bulletinFile = null): void
    {
        $this->bulletinFile = $bulletinFile;

        if (null !== $bulletinFile) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTimeImmutable();
        }
    }

    public function getBulletin(): ?string
    {
        return $this->bulletin;
    }

    public function setBulletin(?string $bulletin): self
    {
        $this->bulletin = $bulletin;

        return $this;
    }

    public function getLetter(): ?string
    {
        return $this->letter;
    }

    public function setLetter(string $letter): self
    {
        $this->letter = $letter;

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
            $this->preRegistration->setFolder(null);
        }

        // set the owning side of the relation if necessary
        if ($preRegistration !== null && $preRegistration->getFolder() !== $this) {
            $preRegistration->setFolder($this);
        }

        $this->preRegistration = $preRegistration;

        return $this;
    }

    public function __toString()
    {
        return "Dossier";
    }
}
