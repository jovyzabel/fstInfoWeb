<?php

namespace App\Entity;

use App\Repository\TeacherRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TeacherRepository::class)]
class Teacher extends Person
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $diploma = null;

    #[ORM\Column(length: 255)]
    private ?string $grade = null;

    #[ORM\OneToMany(mappedBy: 'teacher', targetEntity: Subject::class)]
    private Collection $teachedSubjects;

    public function __construct()
    {
        $this->teachedSubjects = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDiploma(): ?string
    {
        return $this->diploma;
    }

    public function setDiploma(string $diploma): self
    {
        $this->diploma = $diploma;

        return $this;
    }

    public function getGrade(): ?string
    {
        return $this->grade;
    }

    public function setGrade(string $grade): self
    {
        $this->grade = $grade;

        return $this;
    }

    /**
     * @return Collection<int, Subject>
     */
    public function getTeachedSubjects(): Collection
    {
        return $this->teachedSubjects;
    }

    public function addTeachedSubject(Subject $teachedSubject): self
    {
        if (!$this->teachedSubjects->contains($teachedSubject)) {
            $this->teachedSubjects->add($teachedSubject);
            $teachedSubject->setTeacher($this);
        }

        return $this;
    }

    public function removeTeachedSubject(Subject $teachedSubject): self
    {
        if ($this->teachedSubjects->removeElement($teachedSubject)) {
            // set the owning side to null (unless already changed)
            if ($teachedSubject->getTeacher() === $this) {
                $teachedSubject->setTeacher(null);
            }
        }

        return $this;
    }

}
