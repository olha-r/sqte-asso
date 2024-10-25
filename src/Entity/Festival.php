<?php

namespace App\Entity;

use App\Traits\TimeStamp;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\FestivalRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

#[ORM\Entity(repositoryClass: FestivalRepository::class)]
//#[ORM\HasLifecycleCallbacks]
class Festival
{
   // use TimeStamp;
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $titel = null;

    #[ORM\Column(length: 255)]
    private ?string $slug = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $discription = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $authore = null;

    #[ORM\OneToMany(mappedBy: 'festival', targetEntity: ImageFestival::class, cascade:['persist'])]
    private Collection $image; 

    public function __construct()
    {
        $this->image = new ArrayCollection();
    }

  

   

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitel(): ?string
    {
        return $this->titel;
    }

    public function setTitel(string $titel): static
    {
        $this->titel = $titel;

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

    public function getDiscription(): ?string
    {
        return $this->discription;
    }

    public function setDiscription(?string $discription): static
    {
        $this->discription = $discription;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getAuthore(): ?string
    {
        return $this->authore;
    }

    public function setAuthore(?string $authore): static
    {
        $this->authore = $authore;

        return $this;
    }

    /**
     * @return Collection<int, ImageFestival>
     */
    public function getImage(): Collection
    {
        return $this->image;
    }

    public function addImage(ImageFestival $image): static
    {
        if (!$this->image->contains($image)) {
            $this->image->add($image);
            $image->setFestival($this);
        }

        return $this;
    }

    public function removeImage(ImageFestival $image): static
    {
        if ($this->image->removeElement($image)) {
            // set the owning side to null (unless already changed)
            if ($image->getFestival() === $this) {
                $image->setFestival(null);
            }
        }

        return $this;
    }
}
