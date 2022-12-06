<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\TagRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

#[ORM\Entity(repositoryClass: TagRepository::class)]
class Tag
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $label = null;

    #[ORM\ManyToMany(targetEntity: Article::class, inversedBy: 'tags')]
    private ?Collection $articles = null;

    public function __construct()
    {
        $this->articles = new ArrayCollection();
        
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


    public function getArticles(): ?Article
    {
        return $this->articles;
    }

    public function addArticle(Article $article): self
    {
        // dd($article);
        if (!$this->articles->contains($article)) {
            
            $this->articles->add($article);
            $article->addTag($this);

        }

        return $this;
    }

    public function __toString()
    {
        return $this->label;
    }
}
