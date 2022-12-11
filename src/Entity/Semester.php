<?php

namespace App\Entity;

use App\Repository\SemesterRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SemesterRepository::class)]
class Semester
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;
    
    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?SemesterType $semesterType = null;

    #[ORM\OneToMany(mappedBy: 'semester', targetEntity: UE::class, cascade: ['persist', 'remove'])]
    private Collection $ues;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $code = null;

    #[ORM\ManyToOne(inversedBy: 'semesters')]
    private ?Speciality $speciality = null;

    public function __construct()
    {
        $this->ues = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, UE>
     */
    public function getUes(): Collection
    {
        return $this->ues;
    }

    public function addUe(UE $ue): self
    {
        if (!$this->ues->contains($ue)) {
            $this->ues->add($ue);
            $ue->setSemester($this);
        }

        return $this;
    }

    public function removeUe(UE $ue): self
    {
        if ($this->ues->removeElement($ue)) {
            // set the owning side to null (unless already changed)
            if ($ue->getSemester() === $this) {
                $ue->setSemester(null);
            }
        }

        return $this;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(?string $code): self
    {
        $this->code = $code;

        return $this;
    }
    
    public function getSemesterType(): ?SemesterType
    {
        return $this->semesterType;
    }
    
    public function setSemesterType(?SemesterType $semesterType): self
    {
        $this->semesterType = $semesterType;
        
        return $this;
    }
    
    public function getSpeciality(): ?Speciality
    {
        return $this->speciality;
    }
    
    public function setSpeciality(?Speciality $speciality): self
    {
        $this->speciality = $speciality;
        
        return $this;
    }
    
    public function __toString()
    {
        return $this->code;
    }
}
