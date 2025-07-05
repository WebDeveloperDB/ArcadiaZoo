<?php

namespace App\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;

/**
 * @ODM\Document
 */
class YourDocumentClass
{
    /** @ODM\Id */
    private $id;

    /** @ODM\Field(type="string") */
    private $field;

    // Getters et setters
    public function getId(): ?string
    {
        return $this->id;
    }

    public function getField(): ?string
    {
        return $this->field;
    }

    public function setField(string $field): self
    {
        $this->field = $field;
        return $this;
    }
}
