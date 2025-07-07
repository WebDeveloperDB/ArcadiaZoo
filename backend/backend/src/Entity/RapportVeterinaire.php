<?php

namespace App\Entity;

use App\Repository\RapportVeterinaireRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use App\Entity\Animal;

#[ORM\Entity(repositoryClass: RapportVeterinaireRepository::class)]
class RapportVeterinaire
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['animal:read', 'habitat:read'])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['animal:read', 'habitat:read'])]
    private ?string $etat = null;

    #[ORM\Column(nullable: true)]
    #[Groups(['animal:read', 'habitat:read'])]
    private ?\DateTimeInterface $date = null;


    #[ORM\OneToOne(inversedBy: 'rapportVeterinaire')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Animal $animal = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEtat(): ?string
    {
        return $this->etat;
    }

    public function setEtat(string $etat): static
    {
        $this->etat = $etat;
        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): static
    {
        $this->date = $date;
        return $this;
    }

    public function getDateString(): ?string
{
    return $this->date?->format('Y-m-d H:i:s');
}

    public function getAnimal(): ?Animal
    {
        return $this->animal;
    }

    public function setAnimal(?Animal $animal): static
    {
        $this->animal = $animal;
        return $this;
    }
}


