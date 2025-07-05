<?php

namespace App\Entity;

use App\Repository\HabitatRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use App\Entity\Animal;
use App\Entity\Image;

#[ORM\Entity(repositoryClass: HabitatRepository::class)]
class Habitat
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['habitat:read'])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['habitat:read'])]
    private ?string $nom = null;

    #[ORM\Column(length: 1000)]
    #[Groups(['habitat:read'])]
    private ?string $description = null;

    #[ORM\OneToMany(mappedBy: 'habitat', targetEntity: Animal::class, cascade: ['persist', 'remove'])]
    #[Groups(['habitat:read'])]
    private Collection $animaux;

    #[ORM\OneToMany(mappedBy: 'habitat', targetEntity: Image::class, cascade: ['persist', 'remove'])]
    #[Groups(['habitat:read'])]
    private Collection $images;

    public function __construct()
    {
        $this->animaux = new ArrayCollection();
        $this->images = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;
        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return Collection<int, Animal>
     */
    public function getAnimaux(): Collection
    {
        return $this->animaux;
    }

    public function addAnimal(Animal $animal): static
    {
        if (!$this->animaux->contains($animal)) {
            $this->animaux->add($animal);
            $animal->setHabitat($this);
        }
        return $this;
    }

    public function removeAnimal(Animal $animal): static
    {
        if ($this->animaux->removeElement($animal)) {
            if ($animal->getHabitat() === $this) {
                $animal->setHabitat(null);
            }
        }
        return $this;
    }

    /**
     * @return Collection<int, Image>
     */
    public function getImages(): Collection
    {
        return $this->images;
    }

    public function addImage(Image $image): static
    {
        if (!$this->images->contains($image)) {
            $this->images->add($image);
            $image->setHabitat($this);
        }
        return $this;
    }

    public function removeImage(Image $image): static
    {
        if ($this->images->removeElement($image)) {
            if ($image->getHabitat() === $this) {
                $image->setHabitat(null);
            }
        }
        return $this;
    }
}

