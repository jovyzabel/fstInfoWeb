<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\FolderRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

#[ORM\Entity(repositoryClass: FolderRepository::class)]
#[Vich\Uploadable]
class Folder
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToMany(mappedBy: 'folder', targetEntity: Document::class, cascade: ['persist'])]
    private Collection $documents;

    #[ORM\OneToOne(mappedBy: 'folder', cascade: ['persist', 'remove'])]
    private ?PreRegistration $preRegistration = null;

    public function __construct()
    {
        $this->documents = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, Document>
     */
    public function getDocuments(): Collection
    {
        return $this->documents;
    }

    public function addDocument(Document $document): self
    {
        if (!$this->documents->contains($document)) {
            $this->documents->add($document);
            $document->setFolder($this);
        }

        return $this;
    }

    public function removeDocument(Document $document): self
    {
        if ($this->documents->removeElement($document)) {
            // set the owning side to null (unless already changed)
            if ($document->getFolder() === $this) {
                $document->setFolder(null);
            }
        }

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
}
