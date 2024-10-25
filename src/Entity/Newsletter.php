<?php

namespace App\Entity;

use App\Traits\TimeStamp;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\NewsletterRepository;

#[ORM\Entity(repositoryClass: NewsletterRepository::class)]
#[ORM\HasLifecycleCallbacks]
class Newsletter
{
    use TimeStamp;
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $content = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column]
    private ?bool $is_sent = false;

    #[ORM\ManyToOne(inversedBy: 'newsletters')]
    private ?NesletterCategorie $catNews = null;

   

   

   

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    

    public function isIsSent(): ?bool
    {
        return $this->is_sent;
    }

    public function setIsSent(bool $is_sent): static
    {
        $this->is_sent = $is_sent;

        return $this;
    }

    public function getCatNews(): ?NesletterCategorie
    {
        return $this->catNews;
    }

    public function setCatNews(?NesletterCategorie $catNews): static
    {
        $this->catNews = $catNews;

        return $this;
    }

   

   

   

    
   

}
