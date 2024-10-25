<?php

namespace App\Entity;

use App\Traits\TimeStamp;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\EmissionRepository;

#[ORM\Entity(repositoryClass: EmissionRepository::class)]
//#[ORM\HasLifecycleCallbacks]
class Emission
{
   
    //use TimeStamp;
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $slug = null;

    public function getId(): ?int
    {
        return $this->id;
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
}
