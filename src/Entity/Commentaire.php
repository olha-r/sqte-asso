<?php

namespace App\Entity;

use App\Traits\TimeStamp;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\CommentaireRepository;
use Symfony\Component\Validator\Constraints as Assert;
#[ORM\Entity(repositoryClass: CommentaireRepository::class)]
#[ORM\HasLifecycleCallbacks]
class Commentaire
{
    use TimeStamp;
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 120)]
    private ?string $email = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $content = null;

    #[ORM\Column(length: 200)]
    #[Assert\Length(
        min: 2,
        max: 250, 
        minMessage: 'Le titre doit comporter au moins {{ limit }} caractères',
        maxMessage: 'Le titre  ne peut pas être plus long que {{ limit }} caractères',
    )]
    private ?string $nom = null; 

    #[ORM\ManyToOne(inversedBy: 'comment')]
    private ?Actualites $actualites = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

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

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): static
    {
        $this->content = $content;

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getActualites(): ?Actualites
    {
        return $this->actualites;
    }

    public function setActualites(?Actualites $actualites): static
    {
        $this->actualites = $actualites;

        return $this;
    }



    
}
