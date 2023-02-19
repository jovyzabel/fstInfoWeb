<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\SpecialityRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: SpecialityRepository::class)]
#[ORM\Index(name: 'search_index', columns: ['label', 'description'], flags: ['fulltext'])]
class Speciality
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['get_formation_cycles'])]
    private ?int $id = null;

    #[Groups(['get_formation_cycles'])]
    #[ORM\Column(length: 255)]
    private ?string $label = null;

    #[ORM\Column(length: 255)]
    #[Groups(['get_formation_cycles'])]
    private ?string $code = null;

    #[ORM\ManyToOne(inversedBy: 'specialities')]
    private ?FormationCycle $formationCycle = null;

    #[ORM\Column(length: 255)]
    #[Groups(['get_formation_cycles'])]
    private ?string $slug = null;

    #[ORM\OneToMany(mappedBy: 'speciality', targetEntity: Semester::class)]
    private Collection $semesters;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    #[Groups(['get_formation_cycles'])]
    private ?string $description = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $goals = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $targetedSkills = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $careers = null;

    #[ORM\OneToMany(mappedBy: 'speciality', targetEntity: PreRegistration::class)]
    private Collection $preRegistrations;

    #[ORM\ManyToOne]
    private ?Media $featuredImage = null;

    public function __construct()
    {
        $this->semesters = new ArrayCollection();
        $this->preRegistrations = new ArrayCollection();
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

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(string $code): self
    {
        $this->code = $code;

        return $this;
    }

    public function getFormationCycle(): ?FormationCycle
    {
        return $this->formationCycle;
    }

    public function setFormationCycle(?FormationCycle $formationCycle): self
    {
        $this->formationCycle = $formationCycle;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * @return Collection<int, Semester>
     */
    public function getSemesters(): Collection
    {
        return $this->semesters;
    }

    public function addSemester(Semester $semester): self
    {
        if (!$this->semesters->contains($semester)) {
            $this->semesters->add($semester);
            $semester->setSpeciality($this);
        }

        return $this;
    }

    public function removeSemester(Semester $semester): self
    {
        if ($this->semesters->removeElement($semester)) {
            // set the owning side to null (unless already changed)
            if ($semester->getSpeciality() === $this) {
                $semester->setSpeciality(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->label;
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

    public function getGoals(): ?string
    {
        return $this->goals;
    }

    public function setGoals(?string $goals): self
    {
        $this->goals = $goals;

        return $this;
    }

    public function getTargetedSkills(): ?string
    {
        return $this->targetedSkills;
    }

    public function setTargetedSkills(?string $targetedSkills): self
    {
        $this->targetedSkills = $targetedSkills;

        return $this;
    }

    public function getCareers(): ?string
    {
        return $this->careers;
    }

    public function setCareers(?string $careers): self
    {
        $this->careers = $careers;

        return $this;
    }

    /**
     * @return Collection<int, PreRegistration>
     */
    public function getPreRegistrations(): Collection
    {
        return $this->preRegistrations;
    }

    public function addPreRegistration(PreRegistration $preRegistration): self
    {
        if (!$this->preRegistrations->contains($preRegistration)) {
            $this->preRegistrations->add($preRegistration);
            $preRegistration->setSpeciality($this);
        }

        return $this;
    }

    public function removePreRegistration(PreRegistration $preRegistration): self
    {
        if ($this->preRegistrations->removeElement($preRegistration)) {
            // set the owning side to null (unless already changed)
            if ($preRegistration->getSpeciality() === $this) {
                $preRegistration->setSpeciality(null);
            }
        }

        return $this;
    }

    public function getFeaturedImage(): ?Media
    {
        return $this->featuredImage;
    }

    public function setFeaturedImage(?Media $featuredImage): self
    {
        $this->featuredImage = $featuredImage;

        return $this;
    }
}
