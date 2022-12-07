<?php

namespace App\Entity;

use App\Repository\PromotionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PromotionRepository::class)]
class Promotion
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $label = null;

    #[ORM\OneToMany(mappedBy: 'promotion', targetEntity: Alumni::class)]
    private Collection $alumnis;

    public function __construct()
    {
        $this->alumnis = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function setLabel(string $label): self
    {
        $this->label = $label;

        return $this;
    }

    public function __toString()
    {
        return $this->label;
    }

    /**
     * @return Collection<int, Alumni>
     */
    public function getAlumnis(): Collection
    {
        return $this->alumnis;
    }

    public function addAlumni(Alumni $alumni): self
    {
        if (!$this->alumnis->contains($alumni)) {
            $this->alumnis->add($alumni);
            $alumni->setPromotion($this);
        }

        return $this;
    }

    public function removeAlumni(Alumni $alumni): self
    {
        if ($this->alumnis->removeElement($alumni)) {
            // set the owning side to null (unless already changed)
            if ($alumni->getPromotion() === $this) {
                $alumni->setPromotion(null);
            }
        }

        return $this;
    }
}
