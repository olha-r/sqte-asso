<?php

namespace App\Entity;

use App\Traits\TimeStamp;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\SoutienRepository;

#[ORM\Entity(repositoryClass: SoutienRepository::class)]
//#[ORM\HasLifecycleCallbacks]
class Soutien
{
   // use TimeStamp;
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column]
    private ?float $price = null;

    #[ORM\Column(length: 255)]
    private ?string $slug = null;

    #[ORM\ManyToOne(inversedBy: 'soutiens')]
    private ?CatSoutien $relstn = null;

  
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

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): static
    {
        $this->price = $price;

        return $this;
    }


    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): static
    {
        $this->slug = $slug;

        return $this;
    }

    public function getRelstn(): ?CatSoutien
    {
        return $this->relstn;
    }

    public function setRelstn(?CatSoutien $relstn): static
    {
        $this->relstn = $relstn;

        return $this;
    }

   
}
