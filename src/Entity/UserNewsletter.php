<?php

namespace App\Entity;

use App\Traits\TimeStamp;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use App\Repository\UserNewsletterRepository;
use Doctrine\Common\Collections\ArrayCollection;

#[ORM\Entity(repositoryClass: UserNewsletterRepository::class)]
#[UniqueEntity(fields: ['email'], message: 'Il existe déjà un compte avec cet email')]
#[ORM\HasLifecycleCallbacks]
class UserNewsletter
{
    use TimeStamp;
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true)]
    private ?string $email = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column]
    private ?bool $is_rgpd = true;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $validation_token = null;

    #[ORM\Column]
    private ?bool $isValid = false;


//   public function __toString():string
//   {
//     return $this->getEmail();
//   }

  

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    

    public function isIsRgpd(): ?bool
    {
        return $this->is_rgpd;
    }

    public function setIsRgpd(bool $is_rgpd): static
    {
        $this->is_rgpd = $is_rgpd;

        return $this;
    }

    public function getValidationToke(): ?string
    {
        return $this->validation_token;
    }

    public function setValidationToke(?string $validation_token): static
    {
        $this->validation_token = $validation_token;

        return $this;
    }

    public function isIsValid(): ?bool
    {
        return $this->isValid;
    }

    public function setIsValid(bool $isValid): static
    {
        $this->isValid = $isValid;

        return $this;
    }

   

   

    
}
