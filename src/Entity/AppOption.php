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

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $label = null;

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

    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function setLabel(?string $label): self
    {
        $this->label = $label;

        return $this;
    }

}
