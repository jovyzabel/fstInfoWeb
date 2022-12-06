<?php

namespace App\Entity;

use App\Repository\AlumniRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AlumniRepository::class)]
class Alumni
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToMany(mappedBy: 'alumnies', targetEntity: Promotion::class)]
    private Collection $promotion;

    #[ORM\Column(length: 255)]
    private ?string $profil = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $testimonial = null;

    public function __construct()
    {
        $this->promotion = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, Promotion>
     */
    public function getPromotion(): Collection
    {
        return $this->promotion;
    }

    public function addPromotion(Promotion $promotion): self
    {
        if (!$this->promotion->contains($promotion)) {
            $this->promotion->add($promotion);
            $promotion->setAlumnies($this);
        }

        return $this;
    }

    public function removePromotion(Promotion $promotion): self
    {
        if ($this->promotion->removeElement($promotion)) {
            // set the owning side to null (unless already changed)
            if ($promotion->getAlumnies() === $this) {
                $promotion->setAlumnies(null);
            }
        }

        return $this;
    }

    public function getProfil(): ?string
    {
        return $this->profil;
    }

    public function setProfil(string $profil): self
    {
        $this->profil = $profil;

        return $this;
    }

    public function getTestimonial(): ?string
    {
        return $this->testimonial;
    }

    public function setTestimonial(?string $testimonial): self
    {
        $this->testimonial = $testimonial;

        return $this;
    }
}
