<?php

namespace App\Entity;

use App\Repository\AppOptionRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AppOptionRepository::class)]
class AppOption
{
    const ENROLLMENT_PERIOD = 'enrollment_period';
    
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?bool $isPreEnrollPeriod = null;

    #[ORM\Column]
    private ?bool $displayCISCOOnCarousel = null;

    #[ORM\OneToOne()]
    private ?AcademicYear $currentAcademicYear = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?Teacher $courseLeader = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function isIsPreEnrollPeriod(): ?bool
    {
        return $this->isPreEnrollPeriod;
    }

    public function setIsPreEnrollPeriod(bool $isPreEnrollPeriod): self
    {
        $this->isPreEnrollPeriod = $isPreEnrollPeriod;

        return $this;
    }

    public function isDisplayCISCOOnCarousel(): ?bool
    {
        return $this->displayCISCOOnCarousel;
    }

    public function setDisplayCISCOOnCarousel(bool $displayCISCOOnCarousel): self
    {
        $this->displayCISCOOnCarousel = $displayCISCOOnCarousel;

        return $this;
    }

    public function getCurrentAcademicYear(): ?AcademicYear
    {
        return $this->currentAcademicYear;
    }

    public function setCurrentAcademicYear(?AcademicYear $currentAcademicYear): self
    {
        $this->currentAcademicYear = $currentAcademicYear;

        return $this;
    }

    public function getCourseLeader(): ?Teacher
    {
        return $this->courseLeader;
    }

    public function setCourseLeader(?Teacher $courseLeader): self
    {
        $this->courseLeader = $courseLeader;

        return $this;
    }

}
