<?php

namespace App\Entity;

use App\Repository\AnimalRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use App\Entity\Habitat;
use App\Entity\Image;
use App\Entity\RapportVeterinaire;
use App\Entity\Race;



#[ORM\Entity(repositoryClass: AnimalRepository::class)]
class Animal
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['animal:read', 'habitat:read'])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['animal:read', 'habitat:read'])]
    private ?string $prenom = null;

    #[ORM\Column(type: 'text', nullable: true)]
    #[Groups(['animal:read', 'habitat:read'])]
    private ?string $description = null;

    #[ORM\ManyToOne(targetEntity: Race::class)]
    #[ORM\JoinColumn(nullable: true)]
    #[Groups(['animal:read', 'habitat:read'])]
    private ?Race $race = null;

    #[ORM\ManyToOne(inversedBy: 'animaux')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['animal:read'])]
    private ?Habitat $habitat = null;

    #[ORM\OneToOne(mappedBy: 'animal', cascade: ['persist', 'remove'])]
    #[Groups(['animal:read', 'habitat:read'])]
    private ?RapportVeterinaire $rapportVeterinaire = null;

    #[ORM\OneToMany(mappedBy: 'animal', targetEntity: Image::class, cascade: ['persist', 'remove'])]
    #[Groups(['animal:read', 'habitat:read'])]
    private Collection $images;

    public function __construct()
    {
        $this->images = new ArrayCollection();

    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): static
    {
        $this->prenom = $prenom;
        return $this;
    }

    public function getDescription(): ?string
{
    return $this->description;
}

    public function setDescription(?string $description): self
    {
        $this->description = $description;
        return $this;
    }

    public function getRace(): ?Race
    {
        return $this->race;
    }

    public function setRace(?Race $race): static
    {
        $this->race = $race;
        return $this;
    }

    public function getHabitat(): ?Habitat
    {
        return $this->habitat;
    }

    public function setHabitat(?Habitat $habitat): static
    {
        $this->habitat = $habitat;
        return $this;
    }


    public function getEtat(): ?string
    {
        return $this->rapportVeterinaire?->getEtat();
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
            $image->setAnimal($this);
        }
        return $this;
    }

    public function removeImage(Image $image): static
    {
        if ($this->images->removeElement($image)) {
            if ($image->getAnimal() === $this) {
                $image->setAnimal(null);
            }
        }
        return $this;
    }

}

