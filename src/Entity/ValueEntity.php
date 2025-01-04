<?php

namespace App\Entity;

use App\Repository\ValueEntityRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Gedmo\SoftDeleteable\Traits\SoftDeleteableEntity;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Symfony\Component\Serializer\Attribute\Groups;

#[ORM\Entity(repositoryClass: ValueEntityRepository::class)]
#[Gedmo\SoftDeleteable]
class ValueEntity
{
    use TimestampableEntity;
    use SoftDeleteableEntity;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['value:show', 'value:create', 'value:update'])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['value:index', 'value:show', 'value:create', 'value:update'])]
    private ?string $name = null;

    #[ORM\OneToMany(targetEntity: AttributeValue::class, mappedBy: 'value')]
    private Collection $attributeValues;

    public function __construct()
    {
        $this->attributeValues = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?array
    {
        return json_decode($this->name, true);
    }

    public function setName(array $name): static
    {
        $this->name = json_encode($name, JSON_UNESCAPED_UNICODE);

        return $this;
    }

    public function getAttributeValues(): Collection
    {
        return $this->attributeValues;
    }
}
