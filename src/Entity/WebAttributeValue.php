<?php

namespace App\Entity;

use App\Repository\WebAttributeValueRepository;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Gedmo\SoftDeleteable\Traits\SoftDeleteableEntity;
use Gedmo\Timestampable\Traits\TimestampableEntity;

#[ORM\Entity(repositoryClass: WebAttributeValueRepository::class)]
#[Gedmo\SoftDeleteable]
class WebAttributeValue
{
    use TimestampableEntity;
    use SoftDeleteableEntity;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'webAttributeValues')]
    #[ORM\JoinColumn(nullable: false)]
    private ?WebNomenclature $webNomenclature = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?AttributeValue $attributeValue = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getWebNomenclature(): ?WebNomenclature
    {
        return $this->webNomenclature;
    }

    public function setWebNomenclature(?WebNomenclature $webNomenclature): static
    {
        $this->webNomenclature = $webNomenclature;

        return $this;
    }

    public function getAttributeValue(): ?AttributeValue
    {
        return $this->attributeValue;
    }

    public function setAttributeValue(?AttributeValue $attributeValue): static
    {
        $this->attributeValue = $attributeValue;

        return $this;
    }
}
