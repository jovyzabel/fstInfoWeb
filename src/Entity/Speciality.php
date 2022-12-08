<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\SpecialityRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: SpecialityRepository::class)]
class Speciality
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups([
    'get_formation_cyles'])]
    private ?int $id = null;

    #[Groups(['get_formation_cyles'])]
    #[ORM\Column(length: 255)]
    private ?string $label = null;

    #[ORM\Column(length: 255)]
    #[Groups(['get_formation_cyles'])]
    private ?string $code = null;

    #[ORM\OneToMany(mappedBy: 'speciality', targetEntity: SemesterUes::class)]
    private Collection $semesterUes;

    #[ORM\ManyToOne(inversedBy: 'specialities')]
    private ?FormationCycle $formationCycle = null;

    public function __construct()
    {
        $this->semesterUes = new ArrayCollection();
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

    /**
     * @return Collection<int, SemesterUes>
     */
    public function getSemesterUes(): Collection
    {
        return $this->semesterUes;
    }

    public function addSemesterUe(SemesterUes $semesterUe): self
    {
        if (!$this->semesterUes->contains($semesterUe)) {
            $this->semesterUes->add($semesterUe);
            $semesterUe->setSpeciality($this);
        }

        return $this;
    }

    public function removeSemesterUe(SemesterUes $semesterUe): self
    {
        if ($this->semesterUes->removeElement($semesterUe)) {
            // set the owning side to null (unless already changed)
            if ($semesterUe->getSpeciality() === $this) {
                $semesterUe->setSpeciality(null);
            }
        }

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
}
