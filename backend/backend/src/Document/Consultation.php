<?php

namespace App\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

#[MongoDB\Document(collection: "consultations")]
class Consultation
{
    #[MongoDB\Id]
    protected $id;

    #[MongoDB\Field(type: "int")]
    protected $animalId;

    #[MongoDB\Field(type: "int")]
    protected $count = 0;

    public function getId(): ?string
    {
        return $this->id;
    }

    public function getAnimalId(): ?int
    {
        return $this->animalId;
    }

    public function setAnimalId(int $animalId): self
    {
        $this->animalId = $animalId;
        return $this;
    }

    public function getCount(): int
    {
        return $this->count;
    }

    public function setCount(int $count): self
    {
        $this->count = $count;
        return $this;
    }

    public function increment(): self
    {
        $this->count++;
        return $this;
    }
}